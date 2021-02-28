<?php 

class ProjectsLoader extends Loader{

    public function __construct(ProjectsStorage $projectsStorage)
    {
        parent::__construct($projectsStorage);
    }

    public function getProjects(){
        $fetchedProjects = $this->storage->fetchAll();

        $projects = [];

        foreach($fetchedProjects as $project){
            $projects[] = $this->convertToObject($project);
        }

        $this->projectsCount = count($projects);

        return $projects;
    }

    public function getProjectById($id){
        $singleProject = $this->storage->fetchSingle($id);

        return $this->convertToObject($singleProject);
    }

    public function projectExists($project_id){
        return $this->storage->checkIfProjectExists($project_id);
    }

    public function addNewProject($title, $groups_count, $max_students){
        return $this->storage->addNewProject($title, $groups_count, $max_students);
    }

    /**
     * Converts array project object to Project object
     *
     * @param array $project
     * @return Project
     */
    protected function convertToObject($project){
        $newProject = new Project($project["id"], $project["title"], $project["groups_count"], $project["max_students"]);

        return $newProject;
    }

    public function getCount(){
        return $this->projectsCount;
    }
}