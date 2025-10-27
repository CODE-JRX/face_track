import face_recognition
known_faces = {

    "13": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/13.jpg"))[0],

    "24": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/24.jpg"))[0],


    "26": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/26.jpg"))[0],    "33": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/33.jpg"))[0],

    "34": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/34.jpg"))[0],

    "35": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/35.jpg"))[0],

    "36": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/36.jpg"))[0],

    "37": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/37.jpg"))[0],

    "38": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/38.jpg"))[0],

    "39": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/39.jpg"))[0],

    "40": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/40.jpg"))[0],

    "41": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/41.jpg"))[0],

    "42": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/42.jpg"))[0],

    "43": face_recognition.face_encodings(
        face_recognition.load_image_file("Employees/43.jpg"))[0],

}