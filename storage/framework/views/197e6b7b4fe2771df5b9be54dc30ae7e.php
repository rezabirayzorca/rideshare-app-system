

<?php $__env->startSection('content'); ?>

<h1 class="text-2xl font-bold mb-6">Driver Dashboard</h1>

<div class="flex justify-between items-center mb-6">

    <a href="/driver/create"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Create Ride
    </a>

</div>

<?php $__currentLoopData = $rides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php
    $totalSeats = 0;
    $totalEarnings = 0;
?>

<div class="bg-white p-4 rounded shadow mb-4">

    <!-- RIDE INFO -->
    <h2 class="font-bold text-lg">
        <?php echo e($ride->origin); ?> → <?php echo e($ride->destination); ?>

    </h2>

    <p class="text-sm text-gray-600">
        <?php echo e($ride->date); ?> | <?php echo e($ride->time); ?>

    </p>

    <!-- BOOKINGS -->
    <h3 class="mt-3 font-semibold">Bookings:</h3>

    <?php $__empty_1 = true; $__currentLoopData = $ride->bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <?php
            $fare = $booking->seats * $ride->price_per_seat;
            $totalSeats += $booking->seats;
            $totalEarnings += $fare;
        ?>

        <div class="border p-3 mt-2 rounded">

            <p>Passenger: <?php echo e($booking->passenger->name); ?></p>

            <p>Seats Booked: 
                <span class="font-bold"><?php echo e($booking->seats); ?></span>
            </p>

            <p>Total Fare: 
                <span class="text-green-600 font-bold">
                    ₱<?php echo e($fare); ?>

                </span>
            </p>

            <p>Status: 
                <span class="font-bold text-blue-600">
                    <?php echo e($booking->status); ?>

                </span>
            </p>

            <!-- ACTION BUTTONS -->
            <?php if($booking->status == 'pending'): ?>

            <div class="mt-2 flex gap-2">

                <form method="POST" action="/booking/<?php echo e($booking->id); ?>/accept">
                    <?php echo csrf_field(); ?>
                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                        Accept
                    </button>
                </form>

                <form method="POST" action="/booking/<?php echo e($booking->id); ?>/reject">
                    <?php echo csrf_field(); ?>
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Reject
                    </button>
                </form>

            </div>

            <?php endif; ?>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-gray-500 mt-2">No bookings yet.</p>
    <?php endif; ?>

    <!-- SUMMARY -->
    <div class="mt-4 bg-gray-100 p-3 rounded">

        <p class="text-sm">
            Total Seats Booked:
            <span class="font-bold"><?php echo e($totalSeats); ?></span>
        </p>

         <p class="text-blue-600">
        Fare per seat: ₱<?php echo e($booking->ride->price_per_seat); ?>

    </p>
    
        <p class="text-sm text-green-700">
            Total Earnings:
            <span class="font-bold">₱<?php echo e($totalEarnings); ?></span>
        </p>

    </div>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rideshare-system-app\resources\views/driver/dashboard.blade.php ENDPATH**/ ?>