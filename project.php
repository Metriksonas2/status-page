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
}
else{
    header("Location: ./index.php?err=nosuchproject");
}

?>

<?php include_once("./header.php"); ?>

    <div class="container" id="app">

        <!-- <h2 class="text-center">Add Student</h2>
        <div class="row">
            <div class="text-center signup-form my-form col-md-6">
                <form action="includes/add_student.inc.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" name="first_name" id="first_name" required="required">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input class="form-control" type="text" name="last_name" id="last_name" required="required">
                    </div>

                    <div class="form-group">
                        <input class="form-control btn btn-lg btn-primary" style="" type="submit" name="submit" value="Add Student">
                    </div>
                </form>
            </div>
        </div> -->

        <div class="jumbotron bot-jumbotron jumbotron-fluid text-center">
            <div class="container">
                <h1 class="display-4 title-border-bottom"><?php echo $project->getTitle(); ?></h1>
                <p class="lead mt-3">Number of groups: <strong style="font-size: 1.5rem"><?php echo $project->getGroup_count(); ?></strong></p>
                <p class="lead">Maximum amount of students in group: <strong style="font-size: 1.5rem"><?php echo $project->getMax_students(); ?></strong></p>
            </div>
        </div>

        <h2 class="text-center mt-2 my-font"> Project Students</h2>
        <div class="row">
            <table class="table mt-2">
                <thead class="thead-light">
                    <tr>
                        <th>Student</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($students as $student): ?>
                        <tr>
                            <td><?php echo strval($student); ?></td>
                            <td><?php echo $student->getGroup(); ?></td>
                            <td>Delete</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <!-- <td><input class="form-control btn btn-lg btn-primary" style="width: 40%" type="submit" name="submit" value="Add Student"></td> -->
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button class="form-control btn btn-lg btn-primary" id="show-modal" @click="showModal = true">Add Student</button>
                <modal v-if="showModal" @close="showModal = false">
                    <h3 slot="header">Add Student</h3>
                </modal>
            </div>
        </div>
    </div>

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
                                        <button class="modal-default-button form-control btn btn-lg btn-success" @click="$emit('close')" name="submit">Add</button>
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
    <script src="./js/script.js"></script>
</body>
</html>