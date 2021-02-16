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

    private function convertProjectToObject($project){
        $newProject = new Project($project["title"], $project["groups_count"], $project["max_students"]);

        return $newProject;
    }

    public function getCount(){
        return $this->projectsCount;
    }
}