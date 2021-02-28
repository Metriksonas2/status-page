<?php 

class GroupsLoader extends Loader{

    public function __construct(GroupsStorage $groupsStorage)
    {
        parent::__construct($groupsStorage);
    }

    public function getGroups(){
        $fetchedGroups = $this->storage->fetchAll();

        $groups = [];

        foreach($fetchedGroups as $group){
            $groups[] = $this->convertToObject($group);
        }

        return $groups;
    }

    public function getProjectGroups($project_id){
        $fetchedGroups = $this->storage->fetchProjectGroups($project_id);

        return $this->addGroupsToArray($fetchedGroups);
    }

    public function getNotFullProjectGroups($project_id, $max_students){
        $fetchedGroups = $this->storage->fetchNotFullProjectGroups($project_id, $max_students);

        return $this->addGroupsToArray($fetchedGroups);
    }

    public function getGroup($id){
        $singleGroup = $this->storage->fetchSingle($id);
        
        if($singleGroup !== null){
            return $this->convertToObject($singleGroup);
        }
        return $singleGroup;
    }

    public function addGroups($project_id, $groups_count){
        return $this->storage->addGroups($project_id, $groups_count);
    }

    private function addGroupsToArray($groups){
        $groups_arr = [];

        foreach($groups as $group){
            $groups_arr[] = $this->convertToObject($group);
        }
        
        return $groups_arr;
    }

    /**
     * Converts array group object to Group object
     *
     * @param array $group
     * @return Group
     */
    protected function convertToObject($group){
        $newGroup = new Group($group["id"], $group["project_id"], $group["name"], $group["student_count"]);

        return $newGroup;
    }
}