<div class="mb-1 md:mr-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h5 class="font-semibold text-center text-lg text-gray-800 leading-tight pb-1">{{ $category->title }}</h5>
        @include('content.schedule.subcategory', ['title' => 'Overview', 'content' => $category->contentsOverview])
        @include('content.schedule.subcategory', ['title' => 'Content', 'content' => $category->contentsContent])
        @include('content.schedule.subcategory', ['title' => 'Review', 'content' => $category->contentsReview])
        @include('content.schedule.subcategory', ['title' => 'Practice', 'content' => $category->contentsPractice])
        @include('content.schedule.subcategory', ['title' => 'CARs', 'content' => $category->contentsCars])
    </div>
</div>
