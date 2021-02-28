<?php 

class MessageHandler{

    const ERR_NO_SUCH_PROJECT = "nosuchproject";
    const ERR_NO_PROJECT_CHOSEN = "noprojectchosen";
    const ERR_STUDENT_EXISTS = "studentexists";
    const ERR_INCORRECT_DATA = "incorrectdata";
    const ERR_GROUP_IS_FULL = "groupisfull";
    const ERR_MISSING_ARGUMENTS = "missingarguments";

    const SUCCESS_PROJECT_ADDED = "projectadded";
    const SUCCESS_STUDENT_ADDED = "studentadded";
    const SUCCESS_STUDENT_DELETED = "studentdeleted";
    
    public static function getMessage($key){

        $messages_array = self::getAllMessages();
        
        if(array_key_exists($key, $messages_array)){
            return $messages_array[$key];
        }

        return false;
    }

    private static function getAllMessages(){
        return array(

            self::ERR_NO_SUCH_PROJECT => "There is no such project",
            self::ERR_NO_PROJECT_CHOSEN => "None of the projects were chosen",
            self::ERR_STUDENT_EXISTS => "Student with such name exists",
            self::ERR_INCORRECT_DATA => "Incorrect data",
            self::ERR_GROUP_IS_FULL => "Group is full",
            self::ERR_MISSING_ARGUMENTS => "Make sure to provide all required arguments (first_name, last_name and project_id)",
            self::SUCCESS_PROJECT_ADDED => "Project was added successfully!",
            self::SUCCESS_STUDENT_ADDED => "Student was added!",
            self::SUCCESS_STUDENT_DELETED => "Student was deleted"

        );
    }
}