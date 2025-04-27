

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Expenses</h1>
    <a href="<?php echo e(route('expenses.create')); ?>" class="btn">Add New Expense</a>
</div>

<div class="card">
    <div class="card-header">All Expenses</div>
    <div class="card-body">
        <?php if($expenses->count() > 0): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Created By</th>
                            <th>Split Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 500;"><?php echo e($expense->description); ?></div>
                                </td>
                                <td><?php echo e(date('M d, Y', strtotime($expense->expense_date))); ?></td>
                                <td><span style="font-weight: 600;">$<?php echo e(number_format($expense->amount, 2)); ?></span></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 30px; height: 30px; background-color: <?php echo e('#' . substr(md5($expense->creator->id), 0, 6)); ?>; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                            <?php echo e(strtoupper(substr($expense->creator->name, 0, 1))); ?>

                                        </div>
                                        <span><?php echo e($expense->creator->name); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge <?php echo e($expense->split_method === 'equal' ? 'badge-equal' : 'badge-custom'); ?>">
                                        <?php echo e(ucfirst($expense->split_method)); ?>

                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="<?php echo e(route('expenses.show', $expense->id)); ?>" class="btn btn-sm">View</a>
                                        <?php if($expense->created_by == Auth::id()): ?>
                                            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>" class="btn btn-sm btn-secondary">Edit</a>
                                            <form action="<?php echo e(route('expenses.destroy', $expense->id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center" style="padding: 60px 0;">
                <div style="font-size: 4rem; margin-bottom: 20px;">📋</div>
                <h3 style="margin-bottom: 10px; color: var(--text-color);">No Expenses Yet</h3>
                <p style="color: var(--light-text); margin-bottom: 20px; max-width: 500px; margin-left: auto; margin-right: auto;">
                    You haven't added any expenses yet. Start tracking your shared expenses by adding your first expense.
                </p>
                <a href="<?php echo e(route('expenses.create')); ?>" class="btn">Add Your First Expense</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row" style="margin-top: 30px;">
    <div class="col">
        <div class="card">
            <div class="card-header">Quick Actions</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="<?php echo e(route('expenses.create')); ?>" style="text-decoration: none;">
                            <div class="stat-card">
                                <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.1); color: #6366f1;">➕</div>
                                <div class="stat-content">
                                    <h3>Add Expense</h3>
                                    <p style="font-size: 1rem;">Add a new shared expense</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="<?php echo e(route('reports')); ?>" style="text-decoration: none;">
                            <div class="stat-card">
                                <div class="stat-icon" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">📊</div>
                                <div class="stat-content">
                                    <h3>View Reports</h3>
                                    <p style="font-size: 1rem;">See who owes what</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.d-flex {
    display: flex;
}
.justify-content-between {
    justify-content: space-between;
}
.align-items-center {
    align-items: center;
}
.mb-4 {
    margin-bottom: 24px;
}
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Projects\expense-splitter\resources\views/expenses/index.blade.php ENDPATH**/ ?>