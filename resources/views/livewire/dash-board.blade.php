@section('title') Dashboard @endsection
<div class="h-fit m-5">

    <div class="p-4 text-center font-bold text-3xl pt-24 pb-8 ">
        <h3>Dashboard</h3>
    </div>

    <div class="p-3 grid gap-2 grid-cols-1 md:grid-cols-3 grid-rows-1 w-auto h-auto text-slate-700 ">
        <div >
            <x-stat
                class="bg-slate-100 rounded "
                title="Macro"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-up"
                color="text-green-700"
                />
        </div>
        <div >
            <x-stat
            class="bg-slate-100 rounded "
            title="Micro"
            description="This month"
            value="34"  
            icon="o-arrow-trending-down"
            color="text-red-700"
            />
        </div>
        <div >
            <x-stat
            title="Medicine"
            description="This month"
            value="22.124"
            icon="o-arrow-trending-down"
            class=" bg-slate-100 rounded"
            color="text-red-700 "
            />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 pt-12 space-x-3">
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>Toonage Per Day</p><x-chart wire:model="Toonageperday"/></div>
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>Tons Produce over Target</p><x-chart wire:model="TonsProduceOverTarget"/></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 pt-12 space-x-3">
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>Tons per hour</p><x-chart wire:model="TonsPerHour"/></div>
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>kwH per kilos</p><x-chart wire:model="kwHPerKilos"/></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 pt-12 space-x-3 ">
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>Man hour per kilos</p><x-chart wire:model="ManHourPerKilos"/></div>
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>O.T cost per kilos</p><x-chart wire:model="OTCostPerKilos"/></div>
    </div>
    <div class="pt-4">
        <div class="bg-blend-soft-light shadow-xl bg-slate-100 text-center font-bold text-lg space-y-2"><p>Electric Cost</p><x-chart wire:model="ElectricCost"/></div>
    </div>
</div>
