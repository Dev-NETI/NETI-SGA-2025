<x-view-main-content-v2 pageTitle="{{ $title }}">

    <div class="sm:col-span-1 md:col-span-3 lg:col-span-6">

        <div class="md:flex mt-8">

            <ul
                class="flex-column space-y space-y-4 text-sm font-medium 
            text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">

                <x-tab-button route="dashboard.summary" :active="false" label="Summary" />
                <x-tab-button route="dashboard.fc007" :active="true" label="FC-007" />

            </ul>

            <x-tab-content title="{{ $contentTitle }}">

                <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-12 gap-6">

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Generate Board" cardDescription="Generate F-FC-007 report here."
                            x-on:click="$wire.redirectToMaintenance('{{ 1 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Verification Board"
                            cardDescription="Verify generated F-FC-007 report here."
                            x-on:click="$wire.redirectToMaintenance('{{ 2 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Approval Board"
                            cardDescription="Approve F-FC-007 report and send to client."
                            x-on:click="$wire.redirectToMaintenance('{{ 3 }}')" />
                    </div>

                </div>

            </x-tab-content>

        </div>

    </div>

</x-view-main-content-v2>
