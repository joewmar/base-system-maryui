@section('title') Dashboard @endsection
<div class="h-fit m-5">

    <div class="p-4 text-center font-bold text-3xl pt-24 pb-8 ">
        <h3>Dashboard</h3>
    </div>

    <div class="p-3 grid gap-2 grid-cols-1 md:grid-cols-3 grid-rows-1 w-auto h-auto text-slate-700 ">
        <div href="" class="grid-cols-2 grid grid-rows-2 space-y-1 font-semibold h-32 p-3 rounded-lg items-center text-start shadow-xl border border-black hover:bg-slate-300   hover:text-gray-700">
            <div class="text-3xl">10,000</div>
            <div class="row-span-full text-5xl "><i class="fa-brands fa-nutritionix"></i></div>
            <div class="">Macro</div>
        </div>
        <div href="" class="grid-cols-2 grid grid-rows-2 space-y-1 font-semibold h-32 p-3 rounded-lg items-center text-start shadow-xl border border-black hover:bg-slate-300   hover:text-gray-700">
            <div class="text-3xl">10,000</div>
            <div class="row-span-full text-5xl "><i class="fa-solid fa-pills"></i></div>
            <div class="">Micro</div>
        </div>
        <div href="" class="grid-cols-2 grid grid-rows-2 space-y-1 font-semibold h-32 p-3 rounded-lg items-center text-start shadow-xl border border-black hover:bg-slate-300   hover:text-gray-700">
            <div class="text-3xl">10,000</div>
            <div class="row-span-full text-5xl"><i class="fa-solid fa-syringe"></i></div>
            <div class="">Medicine</div>
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
