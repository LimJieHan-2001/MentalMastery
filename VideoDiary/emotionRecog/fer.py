import cv2
from deepface import DeepFace
from collections import Counter

import requests
import os
import glob

# Load pre-trained model for facial emotion recognition
model = DeepFace.build_model("Emotion")

# Define emotion labels
emotion_labels = ['angry', 'disgust', 'fear', 'happy', 'sad', 'surprise', 'neutral']

# Create a counter to keep track of emotions
emotion_counter = Counter()

# Load face cascade classifier
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

# Directory path
dir_path = "C:/XAMPP/htdocs/uploads/"

# Get list of all files, and sort them by creation date
files = glob.glob(dir_path + "*.webm")
files.sort(key=os.path.getctime, reverse=True)

# Get the most recently created file
latest_file = files[0]

# Now you can use latest_file as your video path
video_path = latest_file

cap = cv2.VideoCapture(video_path)

frame_width = int(cap.get(3))
frame_height = int(cap.get(4))

# Create a VideoWriter object
out = cv2.VideoWriter('annotated_video.avi', cv2.VideoWriter_fourcc('D','I','V','X'), 10, (frame_width, frame_height))

while True:
    # Capture frame-by-frame
    ret, frame = cap.read()

    # Check if frame is not empty
    if ret:
        # Convert frame to grayscale
        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    else:
        print("Can't receive frame or stream has ended.")
        break

    # Detect faces in the frame
    faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    for (x, y, w, h) in faces:
        # Extract the face ROI (Region of Interest)
        face_roi = gray_frame[y:y + h, x:x + w]

        # Resize the face ROI to match the input shape of the model
        resized_face = cv2.resize(face_roi, (48, 48), interpolation=cv2.INTER_AREA)

        # Normalize the resized face image
        normalized_face = resized_face / 255.0

        # Reshape the image to match the input shape of the model
        reshaped_face = normalized_face.reshape(1, 48, 48, 1)

        # Predict emotions using the pre-trained model
        preds = model.predict(reshaped_face)[0]
        emotion_idx = preds.argmax()
        emotion = emotion_labels[emotion_idx]
        emotion_counter[emotion] += 1

        # Draw rectangle around face and label with predicted emotion
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 0, 255), 2)
        cv2.putText(frame, emotion, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 0, 255), 2)

    # Write the resulting frame to the output video file
    out.write(frame)

    # Display the resulting frame
    cv2.imshow('Real-time Emotion Detection', frame)

    # Press 'q' to exit
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Determine the most frequently detected emotion
most_common_emotion = emotion_counter.most_common(1)[0][0]
print(f"The most common emotion in the video was: {most_common_emotion}")

# At the end of your script, write the output to a file
with open('emotion_output.txt', 'w') as f:
    f.write(f"{most_common_emotion}")

# Release the capture and close all windows
cap.release()
cv2.destroyAllWindows()