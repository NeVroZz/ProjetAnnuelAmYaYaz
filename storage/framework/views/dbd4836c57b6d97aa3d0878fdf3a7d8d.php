

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4 text-center">Liste des Utilisateurs</h2>

    <!-- Barre de recherche -->
    <div class="d-flex justify-content-center mb-3">
        <form method="GET" action="<?php echo e(route('utilisateurs.index')); ?>" class="d-flex w-50">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Rechercher..." class="form-control me-2">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
    <!-- Pagination centrée propre -->
    <div class="d-flex justify-content-center mt-3">
        <?php echo $utilisateurs->onEachSide(1)->links('pagination::bootstrap-5'); ?>

    </div>
    <!-- Tableau des utilisateurs -->
    <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Type</th>
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
                    <td><span class="badge bg-info text-dark"><?php echo e(ucfirst($utilisateur->type_utilisateur)); ?></span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="<?php echo e(route('utilisateurs.destroy', $utilisateur->id_utilisateur)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination centrée -->
    <div class="d-flex justify-content-center mt-3">
        <?php echo $utilisateurs->links('pagination::bootstrap-5'); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\code\test\resources\views/utilisateurs/index.blade.php ENDPATH**/ ?>