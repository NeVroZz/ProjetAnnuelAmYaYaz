

<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User Management</h2>
        <form method="GET" action="<?php echo e(route('utilisateurs.index')); ?>" class="d-flex" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Search users..." value="<?php echo e(request('search')); ?>">
            <button class="btn btn-primary">Apply Filters</button>
        </form>
    </div>

    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $utilisateurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $utilisateur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($utilisateur->id_utilisateur); ?></td>
                    <td><?php echo e($utilisateur->nom); ?></td>
                    <td><?php echo e($utilisateur->prenom); ?></td>
                    <td><?php echo e($utilisateur->email); ?></td>
                    <td>
                        <span class="badge bg-<?php echo e($utilisateur->type_utilisateur === 'admin' ? 'danger' :
                            ($utilisateur->type_utilisateur === 'client' ? 'primary' :
                            ($utilisateur->type_utilisateur === 'commercant' ? 'warning' :
                            ($utilisateur->type_utilisateur === 'livreur' ? 'success' : 'info')))); ?> badge-role">
                            <?php echo e(ucfirst($utilisateur->type_utilisateur)); ?>

                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Modifier</a></li>
                                <li><form action="<?php echo e(route('utilisateurs.destroy', $utilisateur->id_utilisateur)); ?>" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="dropdown-item text-danger">Supprimer</button>
                                </form></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            <?php echo e($utilisateurs->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\code\test\resources\views/utilisateurs/index.blade.php ENDPATH**/ ?>