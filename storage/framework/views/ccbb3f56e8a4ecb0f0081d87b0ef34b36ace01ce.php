<?php $__env->startSection('content'); ?>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    
    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css"/>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <div class="container-fluid app-body">
        <div class="row">
            <form method="get" action="<?php echo e(route('new.store')); ?>" id="myForm">
                <div class="col-md-3 form-group">
                    <input type="text" name="search" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <input class="form-control datepicker" name="date" data-date-format="yyyy-mm-dd">
                </div>
                <div class="col-md-3 form-group">
                    <select name="group" id="group" class="form-control">
                        <option value="">All Groups</option>
                        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($group->type); ?>"><?php echo e($group->type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </div>

            </form>

        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Group Name</th>
                    <th scope="col">Group Type</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Post Text</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($post->groupInfo->name); ?></th>
                        <th><?php echo e($post->groupInfo->type); ?></th>
                        <th class="content-center"><img width="50" class="media-object img-circle"
                                                        src="<?php echo e($post->accountInfo->avatar); ?>" alt=""></th>
                        <th><?php echo e($post->post_text); ?></th>
                        <th><?php echo e(\Carbon\Carbon::parse($post->sent_at)->format('d M, Y h:i a')); ?></th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($posts->links()); ?>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                }
            );

            $('#group').change(function () {
                console.log('change');
                $('#myForm').submit();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>