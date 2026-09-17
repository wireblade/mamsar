<flux:sidebar.group :heading="__('future option')" class="grid">
    <flux:sidebar.group
        expandable
        :expanded="request()->routeIs('future.*')"
        heading="future options"
        class="grid"
    >
        <flux:sidebar.item
            icon="users"
            :href="route('employee.index')"
            :current="request()->routeIs(
            'future.index',
            'future.show',
            'future.edit'
        )"
            wire:navigate
        >
            Employees
        </flux:sidebar.item>

        <flux:sidebar.item
            icon="user-plus"
            :href="route('employee.index')"
            :current="request()->routeIs('future.index')"
            wire:navigate
        >
            Add Employee
        </flux:sidebar.item>
    </flux:sidebar.group>
</flux:sidebar.group>
