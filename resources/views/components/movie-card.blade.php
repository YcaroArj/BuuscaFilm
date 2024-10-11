<div class="h-[300px] w-[200px] mr-5 mb-36">
    <a href="{{ route('movies.show', ['movie' => $movie['id']]) }}">
        <img class="rounded-lg" src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" alt="cartaz">
    </a>
    <div class="mt-2 ">
        <h1 class="text-white font-bold">{{$movie['title']}}</h1>
        <div>
            <span class="text-white">⭐{{floor($movie['vote_average'] * 10) . '%' }}</span>
            <span class="text-white"> | </span>
            <span class="text-white">{{\Carbon\Carbon::parse($movie['release_date'])->locale('pt_BR')->translatedFormat('d M, Y') }}</span>
            <div class="text-gray-400 text-sm">
                @foreach ($movie['genre_ids'] as $genre)
                {{ $genres->get($genre)}} @if (!$loop->last), @endif
                @endforeach
            </div>
        </div>
    </div>
</div>