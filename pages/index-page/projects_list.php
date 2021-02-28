<h2 class="text-center mt-3 mb-4">Your Projects</h2>
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
                    <?php 
                        $projectId = $project->getId();
                        $projectTitle = $project->getTitle();
                        $projectGroupCount = $project->getGroup_count();
                        $projectMaxStudents = $project->getMax_students();
                    ?>
                    <tr>
                        <td><a href="<?php echo "project.php?id=" . $projectId; ?>" style="font-size: 1.05rem; text-decoration: none"><?php echo $projectTitle; ?></a></td>
                        <td><?php echo $projectGroupCount; ?></td>
                        <td><?php echo $projectMaxStudents; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>