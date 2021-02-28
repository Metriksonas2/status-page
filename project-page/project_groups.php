<h2 class="text-center mt-2 my-font"> Project Groups</h2>

<div class="row" id="edit">
    <?php foreach($projectGroups as $group): ?>
        <?php 
            $groupIsFull = $group->getStudent_count() === $maxStudents;
            $groupId = $group->getId();
            $groupName = $group->getName();
            $groupStudentsCount = $group->getStudent_count();
            $groupStudents = $studentsLoader->getGroupStudents($groupId);  
            $notGroupStudents = $studentsLoader->getNotGroupStudents($project_id, $groupId); 
            $i = 0;
        ?>

        <div class="col-md-6 mt-2 mb-2">
            <div class="card <?php if($groupIsFull) echo 'full-group'; ?>" id="<?php echo $groupId; ?>">  

                <div class="card-header my-card-header <?php if($groupIsFull) echo 'full-group-card-header'; ?>">
                    <template v-if="groupsEditMode['group_<?php echo $groupId; ?>']">
                        <input class="form-control" type="text" name="groupName" id="" placeholder="<?php echo $groupName; ?>">    
                    </template>

                    <template v-else>
                        <h5><?php echo $groupName; ?></h5>
                    </template>

                    <a href="#" @click.prevent="fillGroupsEditMode($event)"><i class="fas fa-edit ml-2 pt-2" id="group" name="<?php echo $groupId; ?>"></i></a>
                </div>

                <div class="card-body">
                    <?php for($j = 0; $j < $maxStudents; $j++): ?>
                        <div class="my-card-body">

                            <!-- If clicked on edit -->
                            <template v-if="groupsEditMode['group_<?php echo $groupId; ?>']">
                                <?php if($i < $groupStudentsCount): ?>
                                    <?php 
                                        $remove_id = $groupId . "_" . $groupStudents[$i]->getId(); 
                                    ?>
                                    <form action="includes/remove_student_from_group.inc.php" method="post" id="remove_<?php echo $remove_id; ?>" class="my-card-body" style="width: 100%">
                                        <label for="" class="form-control mb-3"><span><?php echo $groupStudents[$i]; ?></span></label>

                                        <a role="button" href="javascript:void(0)" onclick="document.getElementById('remove_<?php echo $remove_id; ?>').submit()"><i class="fas fa-minus-circle remove-from-group-btn"></i></a>

                                        <input type="hidden" name="student_id" value="<?php echo $groupStudents[$i]->getId(); ?>" />
                                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>" />
                                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
                                    </form>
                                <?php else: ?>
                                    <label for="" class="form-control mb-3"><span>-</span></label>
                                <?php endif; ?>
                            </template>

                            <!-- If not clicked on edit -->
                            <template v-else>
                                <?php if($i < $groupStudentsCount): ?>
                                    <label class="form-control mb-3"><span><?php echo $groupStudents[$i]; ?></span></label>
                                <?php else: ?>
                                    <form action="includes/add_student_to_group.inc.php" method="post" style="width: 100%">
                                        <select class="form-control mb-3" name="student_id" onchange="this.form.submit()">
                                            <option value="#">-</option>
                                            <?php foreach($notGroupStudents as $student): ?>
                                                <?php 
                                                    $studentId = $student->getId();
                                                    $studentGroup = $student->getGroup_id() !== null ? sprintf("&nbsp; (%s)", $student->getGroup()) : "";
                                                ?>
                                                <option value="<?php echo $studentId; ?>"><?php echo $student . $studentGroup; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>" />
                                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
                                    </form>
                                <?php endif; ?>
                            </template>
                        </div>

                        <?php $i++; ?>
                    <?php endfor; ?>

                    <?php if($groupIsFull): ?>
                        <div class="full-group-msg"><i class="fas fa-bell" style="font-size: 1.5rem;"></i> <strong>Group is full</strong></div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>