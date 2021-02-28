<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();
$projectsLoader = $serviceContainer->getProjectsLoader();
$projects = $projectsLoader->getProjects();

?>

<?php include_once("./header.php"); ?>

    <div class="container" id="app">
        <!--  -->

        <?php include_once(__DIR__ . "/pages/index-page/projects_list.php"); ?>

        <!--  -->

        <!-- Message Handler -->
        <?php 
        
            if(($err = isset($_GET["err"])) || isset($_GET["success"])){
                include_once(__DIR__ . "/message_display.php");
            }

        ?>
        <!-- End Message Handler -->
        
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
    </div>

    <!-- Create Project Modal Button -->

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

    <!-- End of Create Project Modal Button -->

    <script src="./js/script.js"></script>
</body>
</html>