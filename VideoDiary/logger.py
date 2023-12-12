import mysql.connector

def log_data(video_name, video_url, most_common_emotion):
    try:
        # Connect to the MySQL database
        db = mysql.connector.connect(
        host="localhost",
        user="loke",
        password="password123",
        database="videodiarydb"
        )

        print("Successfully connected to the database")

        # Create a cursor object
        cursor = db.cursor()

        # Insert a row of data
        sql = "INSERT INTO video_details (video_name, video_url, most_common_emotion) VALUES (%s, %s, %s)"
        val = (video_name, video_url, most_common_emotion)
        cursor.execute(sql, val)

    except mysql.connector.Error as err:
        print("Failed to connect to the database: {}".format(err))
    
    # Call the function with some test values
    log_data("test_video_name", "test_video_url", "test_most_common_emotion")

    # Commit the changes
    db.commit()

    # Close the connection
    db.close()