<div class="relative">
    <div id="leaderboard-table" class="rounded-md overflow-hidden border-2 border-white w-full mb-4">
        <table class="relative w-full border-0">
                <tr class="font-bold bg-white text-gray-800 overflow-auto">
                    <th colspan="2" class="sticky top-0 left-0 text-left">
                        <span class="inline-block py-2 px-4">Name</span>
                    </th>
                    <th class="sticky top-0 left-0 text-left">
                        <span class="inline-block py-2 px-4">Points</span>
                    </th>
                </tr>
    {{--            <tr>--}}
    {{--                <th class="w-12">--}}
    {{--                    <span class="inline-block pt-4 pl-2">--}}
    {{--                        <img src="{{ asset('awards/gold.png') }}" class="w-6 mx-auto">--}}
    {{--                    </span>--}}
    {{--                </th>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4 font-bold">Christian Dinglasan</span>--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4">1000 pts</span>--}}
    {{--                </td>--}}
    {{--            </tr>--}}
    {{--            <tr>--}}
    {{--                <th class="w-12">--}}
    {{--                    <span class="inline-block pt-4 pl-2">--}}
    {{--                        <img src="{{ asset('awards/silver.png') }}" class="w-6 mx-auto">--}}
    {{--                    </span>--}}
    {{--                </th>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4 font-bold">Christian Dinglasan</span>--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4">1000 pts</span>--}}
    {{--                </td>--}}
    {{--            </tr>--}}
    {{--            <tr>--}}
    {{--                <th class="w-12">--}}
    {{--                    <span class="inline-block pt-4 pl-2">--}}
    {{--                        <img src="{{ asset('awards/bronze.png') }}" class="w-6 mx-auto">--}}
    {{--                    </span>--}}
    {{--                </th>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4 font-bold">Christian Dinglasan</span>--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4">1000 pts</span>--}}
    {{--                </td>--}}
    {{--            </tr>--}}
    {{--            <tr>--}}
    {{--                <th class="w-12">--}}
    {{--                </th>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4 font-bold">Christian Dinglasan</span>--}}
    {{--                </td>--}}
    {{--                <td>--}}
    {{--                    <span class="inline-block pt-5 pb-3 px-4">1000 pts</span>--}}
    {{--                </td>--}}
    {{--            </tr>--}}
                @if($users)
                    @foreach($users as $index => $user)
                        <tr class="text-white">
                            <th class="w-12">
                                <span class="inline-block pt-1 pl-2">
                                @if($user['position'] === 0)
                                    <img src="{{ asset('awards/gold.png') }}" class="w-6 mx-auto">
                                @elseif($user['position'] === 1)
                                    <img src="{{ asset('awards/silver.png') }}" class="w-6 mx-auto">
                                @elseif($user['position'] === 2)
                                    <img src="{{ asset('awards/bronze.png') }}" class="w-6 mx-auto">
                                @endif
                                </span>
                            </th>
                            <td>
                                <span class="inline-block pt-4 pb-5 px-4 font-bold">{{ $user['first_name'] }} {{ $user['last_name'] }}</span>
                            </td>
                            <td>
                                <span class="inline-block pt-4 pb-5 px-4">{{ $user['points'] }} pts</span>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="relative">
        {{ $users->links() }}
    </div>
</div>
