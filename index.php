<?php require_once(__DIR__ . "/bootstrap.php"); ?>

<?php 

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();
$projectsLoader = $serviceContainer->getProjectsLoader();
$projects = $projectsLoader->getProjects();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Status Page</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Your Projects</h2>

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

            <h3 class="text-center">You have no projects, create on now!</h3>
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
                            <td><?php echo $project->getTitle(); ?></td>
                            <td><?php echo $project->getGroup_count(); ?></td>
                            <td><?php echo $project->getMax_students(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Add Project form -->
        <div class="row">
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
                            <input class="form-control btn btn-lg btn-primary" style="" type="submit" name="submit" value="Add Project">
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>