<div>
    @include('livewire.includes.todo-carte')
    @include('livewire.includes.search-box')
    
    <div id="todos-list">
        @include('livewire.includes.todo-tasks')

        <div class="my-2">
            <!-- Pagination goes here -->
        </div>
    </div>
</div>
