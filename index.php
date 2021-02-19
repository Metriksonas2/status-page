<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();
$projectsLoader = $serviceContainer->getProjectsLoader();
$projects = $projectsLoader->getProjects();
?>

<?php include_once("./header.php"); ?>

    <div class="container" id="app">
        <h2 class="text-center">Your Projects</h2>
        <div class="row" id="group">
            <?php if($projectsLoader->getCount() == 0): ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Number of Groups</th>
                            <th>Max Students in Group</th>
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

                <h3 class="col-md-12 text-center mt-4 mb-4" style="color: green">You have no projects, create one now!</h3>
            <?php else: ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Number of Groups</th>
                            <th>Max Students in Group</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($projects as $project): ?>
                            <tr>
                                <td><a href="<?php echo "project.php?id=" . $project->getId(); ?>"><?php echo $project->getTitle(); ?></a></td>
                                <td><?php echo $project->getGroup_count(); ?></td>
                                <td><?php echo $project->getMax_students(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4" style="padding-right: 0 !important;">
                <button class="form-control btn btn-lg btn-primary" id="show-modal" @click="showModal = true">Create Project</button>
                <modal v-if="showModal" @close="showModal = false">
                    <h3 slot="header"></h3>
                </modal>
            </div>
        </div>
        <!-- Add Project form -->
        <!-- <div class="row">
            <div class="text-center signup-form my-form col-md-6 mt-2">
                <form action="includes/add_project.inc.php" method="post">
                    <div class="form-group">
                        <label for="title" style="font-size: 1.2rem">Title</label>
                        <input class="form-control" type="text" name="title" id="title" required="required">
                    </div>

                    <div class="form-group">
                        <label for="groups_count" style="font-size: 1.2rem">Number of Groups</label>
                        <input class="form-control" type="number" name="groups_count" id="groups_count" value="1" min="1" max="10" required="required">
                    </div>

                    <div class="form-group">
                        <label for="max_students" style="font-size: 1.2rem">Max Students in Group</label>
                        <input class="form-control" type="number" name="max_students" id="max_students" value="2" min="2" max="10" required="required">
                    </div>

                    <div class="form-group">
                        <input class="form-control btn btn-lg btn-primary" type="submit" name="submit" value="Create Project">
                    </div>
                </form>
            </div>
        </div> -->
    </div>

    <script type="text/x-template" id="modal-template">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">

                        <div class="modal-header">
                            <slot name="header">Create Project</slot>
                            <button class="btn" @click="$emit('close')"><i class="far fa-window-close modal-close"></i></button>
                        </div>

                        <div class="text-center signup-form my-form col-md-6">
                            <form action="includes/add_project.inc.php" method="post">
                                <div class="modal-body">
                                    <slot name="body">
                                        <div class="form-group">
                                            <label for="title" style="font-size: 1.2rem">Title</label>
                                            <input class="form-control" type="text" name="title" id="title" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="groups_count" style="font-size: 1.2rem">Number of Groups</label>
                                            <input class="form-control" type="number" name="groups_count" id="groups_count" value="1" min="1" max="10" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="max_students" style="font-size: 1.2rem">Max Students in Group</label>
                                            <input class="form-control" type="number" name="max_students" id="max_students" value="2" min="2" max="10" required="required">
                                        </div>
                                    </slot>
                                </div>

                                <div class="modal-footer">
                                    <slot name="footer">
                                        <button class="modal-default-button form-control btn btn-lg btn-success" name="submit">Create Project</button>
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