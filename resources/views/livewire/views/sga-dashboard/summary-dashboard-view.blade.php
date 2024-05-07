<x-view-main-content-v2 pageTitle="{{ $title }}">
    <x-result-message />
    <div class="sm:col-span-1 md:col-span-3 lg:col-span-6">

        <div class="md:flex mt-8">

            <ul
                class="flex-column space-y space-y-4 text-sm font-medium 
            text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">

                <x-tab-button route="dashboard.summary" :active="true" label="Summary" />
                <x-tab-button route="dashboard.fc007" :active="false" label="FC-007" />

            </ul>

            <x-tab-content title="{{ $contentTitle }}">

                <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-12 gap-6">

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Generate Board" dataCount="{{ count($generateBoard) }}" route="sga.letter-index"
                            cardDescription="Generate summary report here." processId="1" route="sga.letter-index"
                            x-on:click="$wire.redirectToMaintenance('{{ 1 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Verification Board" dataCount="{{ count($verificationBoard) }}"
                            cardDescription="Verify generated summary report here." processId="2" route="sga.process-summary"
                            x-on:click="$wire.redirectToMaintenance('{{ 2 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Approval Board" dataCount="{{ count($approvalBoard) }}"
                            cardDescription="Approve Summary report and send to client." processId="3" route="sga.process-summary"
                            x-on:click="$wire.redirectToMaintenance('{{ 3 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Principal Board" dataCount="{{ count($principalBoard) }}"
                            cardDescription="Finished Summary report are saved here." processId="4" route="sga.process-summary"
                            x-on:click="$wire.redirectToMaintenance('{{ 4 }}')" />
                    </div>

                    <div class="col-span-1 md:col-span-3 lg:col-span-4">
                        <x-dashboard-card cardTitle="Close Board" dataCount="{{ count($closeBoard) }}"
                            cardDescription="Finished Summary report are saved here." processId="5" route="sga.process-summary"
                            x-on:click="$wire.redirectToMaintenance('{{ 5 }}')" />
                    </div>

                </div>

            </x-tab-content>

        </div>

    </div>

</x-view-main-content-v2>
