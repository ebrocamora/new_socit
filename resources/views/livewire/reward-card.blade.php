<section class="relative p-6 relative rounded-md bg-black bg-opacity-30" id="task-1">
    <div class="flex items-center">
        <div class="flex-none w-16 sm:w-24 md:w-32 transition-all">
            @if($rewardReceived)
                <img src="{{ asset($reward->image) }}" class="h-auto w-full mx-auto"/>
            @else
                <img src="{{ asset($reward->image_blank) }}" class="h-auto w-full mx-auto"/>
            @endif
        </div>
        <div class="flex-1 ml-4 md:ml-8">
            <p class="font-poppins text-base sm:text-xl md:text-3xl leading-none font-bold text-white tracking-tight transition-all">{{ $reward->name }}</p>
            <span class="text-base">{{ $reward->description }}</span>
        </div>
    </div>
    <div class="relative">
        <div class="relative flex items-center justify-between mt-4">
            <div class="flex-none flex justify-center md:w-32">
                <span class="font-poppins bg-white font-bold text-purple-500 py-1 px-3 rounded-md">{{ $reward->point_count }} pts</span>
            </div>

            @if($claimedOn)
            <div class="flex-none text-right">
                <div class="relative leading-snug">
                    <span class="font-bold text-sm">Claimed on:</span><br/>
                    <span>{{ $claimedOn }}</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
