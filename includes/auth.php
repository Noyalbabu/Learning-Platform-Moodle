<?php
session_start();


// to authorise the enrollment
function authoriseEnrollmentCourse($conn){
    if (isset($_POST['authorise']) && isset($_POST["course"]) && isset($_POST["courseApproved"])){
        $courseId = mysqli_escape_string($conn, $_POST["course"]);
        $studentId = mysqli_escape_string($conn, $_POST["student"]);
        $Approved = mysqli_escape_string($conn, $_POST["courseApproved"]);
        $Approved = 1;
        $sql = "UPDATE studentcourse SET course_approved=$Approved WHERE course_id = $courseId AND student_id = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

    }
}

function rejectEnrollmentCourse($conn){
    // to reject the enrollment.
    if (isset($_POST['reject'])&& isset($_POST["course"])){
        $courseId = mysqli_escape_string($conn,$_POST["course"]);
        $studentId = mysqli_escape_string($conn,$_POST["student"]);
        $Approved = mysqli_escape_string($conn,$_POST["courseApproved"]);
        $sql = "DELETE FROM studentcourse WHERE course_id = $courseId AND student_id = $studentId ";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

function authoriseStudent($conn){
    if (isset($_POST['authorise']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $userAuthorised = mysqli_escape_string($conn,$_POST['userAuthorised']);
        $userAuthorised = 1;
        $sql = "UPDATE user SET userAuthorised = $userAuthorised WHERE id = $id  ";
        if ($conn->query($sql) === TRUE) {
// adding the approved students to 'student' table
            $sqladd = "INSERT INTO student (student_id) VALUES ($id)";
            $res = mysqli_query($conn,$sqladd);
            if ($res){
                echo "Student added to the student table successfully";
            }
        }
        else {
            echo "Error updating record: " . $conn->error;
        }

    }

}
function rejectStudent($conn){
    if(isset($_POST['reject']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

function authoriseTutor($conn){
    if (isset($_POST['authorise']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $userAuthorised = mysqli_escape_string($conn,$_POST['userAuthorised']);
        $userAuthorised = 1;
        $sql = "UPDATE user SET userAuthorised = $userAuthorised WHERE id = $id";
        if(($conn)->query($sql) == True){
            $sqladd = "INSERT INTO tutor (tutor_id) VALUES ($id)";
            if ($conn->query($sqladd) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
}
function rejectTutor($conn){
    if(isset($_POST['reject']) && $_POST['id']){
        $id = mysqli_escape_string($conn,$_POST['id']);
        $sql = "DELETE FROM user where id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

