<x-view-main-content-v2 pageTitle="{{ $title }}">
    <x-result-message />
    <div class="sm:col-span-1 md:col-span-3 lg:col-span-6">

        <div class="md:flex mt-8">

            <ul
                class="flex-column space-y space-y-4 text-sm font-medium 
            text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">

                <x-tab-button route="dashboard.summary" :active="false" label="Letter & Summary" />
                <x-tab-button route="dashboard.fc007" :active="true" label="SGA" />

            </ul>

            <x-tab-content title="{{ $contentTitle }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-6 gap-x-4 md:gap-6 w-full">

                    <div class="col-span-1">
                        <x-dashboard-card cardTitle="Generate Board" cardDescription="Generate F-FC-007 report here."
                            dataCount="{{ $sentBackBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 1 }}','dashboard.fc007-maintenance')" />
                    </div>

                    <div class="col-span-1">
                        <x-dashboard-card cardTitle="Verification Board" route="sga.process-fc007" processId="2"
                            cardDescription="Verify generated F-FC-007 report here." dataCount="{{ $verifyBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 2 }}','dashboard.fc007-maintenance')" />
                    </div>

                    <div class="col-span-1">
                        <x-dashboard-card cardTitle="Comptroller Board"
                            cardDescription="Approve F-FC-007 report." route="sga.process-fc007"
                            processId="3" dataCount="{{ $comptrollerBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 3 }}','dashboard.fc007-maintenance')" />
                    </div>

                    <div class="col-span-1">
                        <x-dashboard-card cardTitle="President Board"
                            cardDescription="Approve F-FC-007 report." route="sga.process-fc007" processId="4"
                            dataCount="{{ $presidentBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 4 }}','dashboard.fc007-maintenance')" />
                    </div>

                    {{-- <div class="col-span-1">
                        <x-dashboard-card cardTitle="O.R Board"
                            cardDescription="Upload Official Receipt here." route="sga.process-fc007" processId="5"
                            dataCount="{{ $OrBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 5 }}','dashboard.fc007-maintenance')" />
                    </div> --}}

                    <div class="col-span-1">
                        <x-dashboard-card cardTitle="Close Board"
                            cardDescription="All finished transactions are stored here." route="sga.process-fc007" processId="5"
                            dataCount="{{ $CloseBoardCount }}"
                            x-on:click="$wire.redirectToMaintenance('{{ 5 }}','dashboard.fc007-maintenance')" />
                    </div>

                </div>
            </x-tab-content>   
        </div>

    </div>

</x-view-main-content-v2>
