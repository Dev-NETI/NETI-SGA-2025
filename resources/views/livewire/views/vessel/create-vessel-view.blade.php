<div class="grid grid-cols-1">
    <div class="flex justify-center items-center">

        <div href="#"
            class="card-layout mt-10 block w-full max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 
                   dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $hash != null ? 'Update Vessel' : 'Create Vessel' }}
            </h5>

            <form class="max-w-md mx-auto mt-8" wire:submit.prevent="{{ $hash != null ? 'update' : 'store' }}">

                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="Vessel" id="Vessel" wire:model="vessel"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                        appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                        focus:border-blue-600 peer"
                        placeholder=" " value="{{$hash != null ? $vessel : old('vessel')}}" />
                    <label for="Vessel"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                        origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                        peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                        peer-focus:-translate-y-6">Vessel</label>
                    @error('vessel')
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                   dark:bg-red-900 dark:text-red-300">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    {{-- <input type="text" name="VesselType" id="VesselType" wire:model="vesselType"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                        appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                        focus:border-blue-600 peer"
                        placeholder=" " /> --}}
                    <select name="VesselType" id="VesselType" wire:model="vesselType"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                                appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                                focus:border-blue-600 peer" placeholder=" ">
                                <option value="">Select</option>
                                @foreach ($vesselTypeData as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                    </select>
                    <label for="VesselType"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                        origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                        peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                        peer-focus:-translate-y-6">Vessel
                        Type</label>
                    @error('vesselType')
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                   dark:bg-red-900 dark:text-red-300">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="Code" id="Code" wire:model="code"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                        appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                        focus:border-blue-600 peer"
                        placeholder=" " value="{{$hash != null ? $code : old('code')}}" />
                    <label for="Code"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                        origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                        peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                        peer-focus:-translate-y-6">Code</label>
                    @error('code')
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                   dark:bg-red-900 dark:text-red-300">{{ $message }}</span>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="Training Fee" id="Training Fee" wire:model="trainingFee"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 
                        appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 
                        focus:border-blue-600 peer"
                        placeholder=" " value="{{$hash != null ? $trainingFee : old('trainingFee')}}" />
                    <label for="Training Fee"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 
                        origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 
                        peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 
                        peer-focus:-translate-y-6">Training
                        Fee</label>
                    @error('trainingFee')
                        <span
                            class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                   dark:bg-red-900 dark:text-red-300">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br 
                    focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg 
                    dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        {{ $hash != null ? 'Update' : 'Create' }}
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
