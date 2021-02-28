<?php 

class ProjectsLoader{

    private $projectsStorage;
    private $projectsCount;

    public function __construct(ProjectsStorage $projectsStorage)
    {
        $this->projectsStorage = $projectsStorage;
    }

    public function getProjects(){
        $fetchedProjects = $this->projectsStorage->fetchAll();

        $projects = [];

        foreach($fetchedProjects as $project){
            $projects[] = $this->convertProjectToObject($project);
        }

        $this->projectsCount = count($projects);

        return $projects;
    }

    public function getProjectById($id){
        $singleProject = $this->projectsStorage->fetchSingle($id);

        return $this->convertProjectToObject($singleProject);
    }

    public function projectExists($project_id){
        return $this->projectsStorage->checkIfProjectExists($project_id);
    }

    /**
     * Converts array project object to Project object
     *
     * @param array $project
     * @return Project
     */
    private function convertProjectToObject($project){
        $newProject = new Project($project["id"], $project["title"], $project["groups_count"], $project["max_students"]);

        return $newProject;
    }

    public function getCount(){
        return $this->projectsCount;
    }
}