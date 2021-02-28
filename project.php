<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

if(isset($_GET["id"])){
    
    $project_id = $_GET["id"];
    $serviceContainer = new ServiceContainer($configuration);
    $projectsLoader = $serviceContainer->getProjectsLoader();

    if($projectsLoader->projectExists($project_id)){
        $project = $projectsLoader->getProjectById($project_id);
        $maxStudents = $project->getMax_students();

        $studentsLoader = $serviceContainer->getStudentsLoader();
        $students = $studentsLoader->getProjectStudents($project_id);

        $groupsLoader = $serviceContainer->getGroupsLoader();
        $projectGroups = $groupsLoader->getProjectGroups($project_id);
        $notFullProjectGroups = $groupsLoader->getNotFullProjectGroups($project_id, $maxStudents);
    }
    else{
        header("Location: ./index.php?err=" . MessageHandler::ERR_NO_SUCH_PROJECT);
    }
}
else{
    header("Location: ./index.php?err=" . MessageHandler::ERR_NO_PROJECT_CHOSEN);
}

?>

<?php include_once("./header.php"); ?>

    <div class="container" id="app">
        <div class="jumbotron bot-jumbotron jumbotron-fluid text-center">
            <div class="container">
                <h1 class="display-4 title-border-bottom"><?php echo $project->getTitle(); ?></h1>
                <p class="lead mt-3">Number of groups: <strong style="font-size: 1.5rem"><?php echo $project->getGroup_count(); ?></strong></p>
                <p class="lead">Maximum amount of students in group: <strong style="font-size: 1.5rem"><?php echo $maxStudents; ?></strong></p>
            </div>
        </div>

        <!-- Students Section -->
        
        <?php include_once(__DIR__ . "/pages/project-page/project_students.php"); ?>

        <!-- End of Students Section -->

        <!-- Message Handler -->

        <?php 
        
            if(($err = isset($_GET["err"])) || isset($_GET["success"])){
                include_once(__DIR__ . "/message_display.php");
            }

        ?>

        <!-- End of Message Handler -->

        <!-- "Add new student" button -->

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button class="form-control btn btn-lg btn-primary" id="show-modal" @click="showModal = true">Add new student</button>
                <modal v-if="showModal" @close="showModal = false">
                    <h3 slot="header">Add new student</h3>
                </modal>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        
        <!-- End of "Add new student" button -->

        <hr>

        <!-- Groups Section -->

        <?php include_once(__DIR__ . "/pages/project-page/project_groups.php"); ?>

        <!-- End of Groups Section -->
    </div>

    <script type="text/javascript">
        // window.onload = function(){
        //     setTimeout(() => {
        //         document.location.reload(true);
        //     }, 10000);
        // }
    </script>

    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">
                                Add Student
                            </slot>
                            <button class="btn" @click="$emit('close')"><i class="far fa-window-close modal-close"></i></button>
                        </div>

                        <div class="text-center signup-form my-form col-md-6">
                            <form action="includes/add_student.inc.php" method="post">
                                <div class="modal-body">
                                    <slot name="body">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input class="form-control" type="text" name="first_name" id="first_name" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input class="form-control" type="text" name="last_name" id="last_name" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="group">Group</label>
                                            <select class="form-control" name="group" id="group">
                                                <option value="">None</option>
                                                <?php foreach($notFullProjectGroups as $group): ?>
                                                    <option value="<?php echo $group->getId(); ?>"><?php echo $group->getName(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <input type="hidden" name="project_id" value="<?php echo $_GET["id"]; ?>" />
                                    </slot>
                                </div>

                                <div class="modal-footer">
                                    <slot name="footer">
                                        <button class="modal-default-button form-control btn btn-lg btn-success" name="submit">Add</button>
                                    </slot>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>

    <script src="./js/script.js"></script>
</body>
</html>