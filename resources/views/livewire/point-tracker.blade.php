<div class="relative flex flex-col sm:flex-row sm:items-center gap-4 justify-between mb-8">
    <div class="flex-none">
        <span class="text-xl font-bold text-white">Points earned: </span>
        <span class="text-xl font-bold text-white">{{ $points }}</span>
    </div>
    @can('rewards:read')
    <div class="flex-none">
        <button type="button" @click="codeInput()" class="bg-white rounded-md py-2 px-4 font-bold">
            Add a code
        </button>
    </div>
    @endcan
</div>
