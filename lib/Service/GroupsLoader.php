<?php 

class GroupsLoader{

    private $groupsStorage;

    public function __construct(GroupsStorage $groupsStorage)
    {
        $this->groupsStorage = $groupsStorage;
    }

    public function getGroups(){
        $fetchedGroups = $this->groupsStorage->fetchAll();

        $groups = [];

        foreach($fetchedGroups as $group){
            $groups[] = $this->convertGroupToObject($group);
        }

        return $groups;
    }

    public function getProjectGroups($project_id){
        $fetchedGroups = $this->groupsStorage->fetchProjectGroups($project_id);

        return $this->addGroupsToArray($fetchedGroups);
    }

    public function getGroup($id){
        $singleGroup = $this->groupsStorage->fetchSingle($id);
        
        if($singleGroup !== null){
            return $this->convertGroupToObject($singleGroup);
        }
        return $singleGroup;
    }

    public function addGroups($project_id, $groups_count){
        $this->groupsStorage->addGroups($project_id, $groups_count);
    }

    private function addGroupsToArray($groups){
        $groups_arr = [];

        foreach($groups as $group){
            $groups_arr[] = $this->convertGroupToObject($group);
        }
        
        return $groups_arr;
    }

    /**
     * Converts array group object to Group object
     *
     * @param array $group
     * @return Group
     */
    private function convertGroupToObject($group){
        $newGroup = new Group($group["id"], $group["project_id"], $group["name"]);

        return $newGroup;
    }
}