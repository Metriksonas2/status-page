<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

if(isset($_GET["id"])){
    
    $serviceContainer = new ServiceContainer($configuration);
    $pdo = $serviceContainer->getPDO();

    $projectsLoader = $serviceContainer->getProjectsLoader();
    $project = $projectsLoader->getProjectById($_GET["id"]);

    // Check if this project exists


    $studentsLoader = $serviceContainer->getStudentsLoader();
    $students = $studentsLoader->getProjectStudents($_GET["id"]);

    $groupsLoader = $serviceContainer->getGroupsLoader();
    $projectGroups = $groupsLoader->getProjectGroups($_GET["id"]);
}
else{
    header("Location: ./index.php?err=nosuchproject");
}

?>

<?php include_once("./header.php"); ?>

    <div class="container" id="app">
        <div class="jumbotron bot-jumbotron jumbotron-fluid text-center">
            <div class="container">
                <h1 class="display-4 title-border-bottom"><?php echo $project->getTitle(); ?></h1>
                <p class="lead mt-3">Number of groups: <strong style="font-size: 1.5rem"><?php echo $project->getGroup_count(); ?></strong></p>
                <p class="lead">Maximum amount of students in group: <strong style="font-size: 1.5rem"><?php echo $project->getMax_students(); ?></strong></p>
            </div>
        </div>

        <!-- Students Section -->
        <h2 class="text-center mt-2 my-font"> Project Students</h2>
        <div class="row">
            <?php if($studentsLoader->getProjectStudentsCount() == 0): ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 44%">Student</th>
                            <th style="width: 28%">Group</th>
                            <th style="width: 28%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="col-md-12 text-center mt-4 mb-4" style="color: green">Add students to your project!</h3>
            <?php else: ?>
                <table class="table mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 44%">Student</th>
                            <th style="width: 28%">Group</th>
                            <th style="width: 7%">Actions</th>
                            <th style="width: 21%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($students as $student): ?>
                            <tr>
                                <td><?php echo strval($student); ?></td>
                                <td><?php echo $student->getGroup() != null ? $student->getGroup() : "No group" ?></td>
                                <td><a href="">Delete</a></td>
                                <td><a href="">Edit Group</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button class="form-control btn btn-lg btn-primary" id="show-modal" @click="showModal = true">Add Student</button>
                <modal v-if="showModal" @close="showModal = false">
                    <h3 slot="header">Add Student</h3>
                </modal>
            </div>
            <div class="col-md-4">
                <!-- <button class="form-control btn btn-lg btn-primary" id="show-modal" @click="showModal = true">Add Student</button>
                <modal v-if="showModal" @close="showModal = false">
                    <h3 slot="header">Add Student</h3>
                </modal> -->
            </div>
        </div>
        <!-- End of Students Section -->
        
        <hr>

        <!-- Groups Section -->
        <h2 class="text-center mt-2 my-font"> Project Groups</h2>
        <div class="row" id="edit">
            <?php foreach($projectGroups as $group): ?>
                <div class="col-md-6 mt-2 mb-2">

                    <div class="card">  

                        <div class="card-header" style="display: flex; justify-content: space-between;">
                            <h5><?php echo $group->getName(); ?></h5>
                            <a href="#" @click.prevent="fillGroupsEditMode($event)"><i class="fas fa-edit pt-2" id="group" name="<?php echo $group->getId(); ?>"></i></a>
                        </div>

                        <div class="card-body">
                            <?php for($j = 1; $j <= $project->getMax_students(); $j++): ?>
                                <div style="display: flex; flex-direction: row;">
                                    <template v-if="groupsEditMode['group_<?php echo $group->getId(); ?>']">
                                        <label for="" class="form-control"><span>Beleka</span></label>
                                        <a href="#" @click.prevent><i class="fas fa-minus-circle" style="margin-left: 5px; padding-left: 5px; padding-top: 13px; text-align: right; color: red"></i>
                                    </template>
                                    <template v-else>
                                        <label for="" class="form-control"></label>
                                    </template>
                                </div>
                            <?php endfor; ?>
                        </div>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <!-- End of Students Section -->
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
                                            </select>
                                        </div>

                                        <input type="hidden" name="project_id" value="<?php echo $_GET["id"]; ?>" />
                                    </slot>
                                </div>

                                <div class="modal-footer">
                                    <slot name="footer">
                                        <button class="modal-default-button form-control btn btn-lg btn-success" name="submit">Add</button>
                                    </slot>
                                    <!-- <div class="form-group">
                                        <input class="form-control btn btn-lg btn-primary" type="submit" name="submit" value="Add ">
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </script>
    <!-- <script src="./js/edit.js"></script> -->
    <script src="./js/script.js"></script>
</body>
</html>