<div>
    <table class="bdr bg-white">
        <thead class="bdr-b">
            <tr>
                <x-gt-table.th wire:click="sortBy('code')" sortable
                    :direction="$this->getSortDirection('code')"> Code </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('Title')" sortable
                    :direction="$this->getSortDirection('Title')"> Course Title </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('status')" sortable alignCenter
                    :direction="$this->getSortDirection('status')"> Status </x-gt-table.th>
                <x-gt-table.th class="tar"> Price </x-gt-table.th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($courses as $course)
                <tr wire:key="{{ $course->id }}">
                    <td> {{ $course->code }} </td>
                    <td> {{ str($course->title)->limit(40) }} </td>
                    <td class="tac">
                        <div class="inline-flex rounded-full txt-xs py-0125 px-05 opacity-08 {{ $course->status->color() }}">
                            {{ $course->status->label() }}
                        </div>
                    </td>
                    <td class="tar"> {{ Illuminate\Support\Number::currency($course->price) }} </td>
                </tr>
            @empty
                <tr>
                    <td class="pxy fw7">No records found...</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $courses->links('gotime::pagination.livewire') }}
</div>
