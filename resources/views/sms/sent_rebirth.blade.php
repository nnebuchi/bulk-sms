@extends('layouts.dashboard.rebirth.app')
@section('title', 'Sent messages')
@section('content')
<div class="mx-auto">
  <div class="mb-6 bg-white shadow-lg rounded-lg p-4 tabletmd:p-8">
    <h1 class="heading-2">Sent Messages</h1>
    <p class="text-sm text-gray-500 mt-1 flex items-center space-x-2">
      <span class="font-normal text-skzdark-200">Dashboard</span>
      <span>-</span>
      <a
        href="#"
        class="text-[#FFCB00] rounded-full text-sm font-medium"
        >Sent</a
      >
    </p>
  </div>

  <div class="relative shadow-md rounded-lg tabletmd:p-8 p-4 bg-white">
    <div class="border border-gray-200 rounded-md overflow-x-auto">
      <nav
        class="flex items-center flex-row justify-between p-4"
        aria-label="Table navigation">
        <div class="flex items-center space-x-2">
          <label for="entries" class="text-sm font-normal text-gray-500"
            >Show</label
          >
          <select
            id="entries"
            class="rounded-lg text-gray-900 border border-gray-300 text-sm mobilelg:py-2 py-1 w-fit ps-1">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
          </select>
          <span class="text-sm font-normal text-gray-500">entries</span>
        </div>

        <div class="">
          <button
            id="filter-button"
            class="flex items-center justify-center bg-transparent text-gray-600 mobilelg:px-4 px-2 mobilelg:py-2 py-1 rounded-md hover:bg-gray-50 transition-colors border border-gray-300 cursor-pointer">
            <span class="fa fa-filter mobilemd:mr-2 mr-0"></span>
            <span class="mobilemd:block hidden">Filter</span>
          </button>

          <div
            id="filter-criteria"
            class="absolute tabletmd:right-40 mobilemd:right-35 right-0 mobilemd:top-1 top-18 w-64 bg-white border border-gray-200 rounded-lg shadow-xl p-4 hidden z-20">
            <div class="space-y-4">
              <div>
                <label
                  for="filter-category"
                  class="block text-sm font-medium text-gray-700 mb-1"
                  >Category</label
                >
                <select
                  id="filter-category"
                  class="w-full rounded-md p-2 text-sm focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none border border-gray-300">
                  <option value="">All Categories</option>
                  <option value="sent">Sent</option>
                  <option value="scheduled">Scheduled</option>
                  <option value="drafts">Drafts</option>
                </select>
              </div>

              <div>
                <label
                  for="filter-date-range"
                  class="block text-sm font-medium text-gray-700 mb-1"
                  >Date Range</label
                >
                <select
                  id="filter-date-range"
                  class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none">
                  <option value="">All Time</option>
                  <option value="today">Today</option>
                  <option value="last-7-days">Last 7 Days</option>
                  <option value="last-30-days">Last 30 Days</option>
                </select>
              </div>

              <div class="flex justify-end space-x-2 pt-2">
                <button
                  id="reset-filter-button"
                  class="px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 border border-gray-700 cursor-pointer">
                  Reset
                </button>
                <button
                  id="apply-filter-button"
                  class="px-4 py-2 text-sm font-medium text-skzdark-200 bg-[#FFCB00] rounded-lg hover:opacity-80 cursor-pointer">
                  Apply Filter
                </button>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <table
        class="w-full text-sm text-left rtl:text-right text-gray-500 overflow-x-auto">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="p-4">
              <div class="flex items-center">
                <input
                  id="checkbox-all-search"
                  type="checkbox"
                  class="w-4 h-4 text-[#FFCB00] bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                <label for="checkbox-all-search" class="sr-only"
                  >checkbox</label
                >
              </div>
            </th>
            <th scope="col" class="mobilesm:px-4 px-2 py-3">Title</th>
            <th scope="col" class="mobilesm:px-4 px-2 py-3">
              Recipient
            </th>
            
            {{-- <th scope="col" class="mobilesm:px-4 px-2 py-3">
              Channels
            </th> --}}
            <th scope="col" class="mobilesm:px-4 px-2 py-3">
              Date/Time
            </th>
            <th scope="col" class="mobilesm:px-4 px-2 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $message)

									@php $contactArr = []; 
										// dd($message->messageStatus->color);
									@endphp

										@php
											foreach ($message->contacts as $key => $contact) {
												
												array_push($contactArr, $contact->title);
											}
										@endphp
          <tr
            class="bg-white border-b border-gray-200 hover:bg-gray-50">
            <td class="w-4 p-4">
              <div class="flex items-center">
                <input
                  id="checkbox-table-search-1"
                  type="checkbox"
                  class="w-4 h-4 text-[#FFCB00] bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2" />
                <label for="checkbox-table-search-1" class="sr-only"
                  >checkbox</label
                >
              </div>
            </td>

            <td class="mobilemd:px-4 px-2 py-4">
              <div class="truncate tabletlg:w-28 mobilemd:w-20 w-16">
                {{$message->title}}
                {{-- 08067557877 + more --}}
              </div>
            </td>
            <td class="mobilemd:px-4 px-2 py-4">
              <div class="truncate tabletlg:w-28 mobilemd:w-20 w-16">
                <?php 
                  if (!empty($contactArr)) {
                      $first = $contactArr[0];
                      $remaining = count($contactArr) - 1;
                      $result = $first;
                      if ($remaining > 0) {
                        $result .= " + {$remaining} others";
                      }
                  } else {
                      $result = "";
                  }

                ?>
                {{ $result }}
              </div>
            </td>
            {{-- <td class="mobilemd:px-4 px-2 py-4">
              <div class="truncate tabletlg:w-28 mobilemd:w-20 w-16">
                Portal
              </div>
            </td> --}}
            <td class="mobilemd:px-4 px-2 py-4">
              <div class="truncate tabletlg:w-28 mobilemd:w-20 w-16">
                {{ date('d.m.Y, H:i', strtotime($message->created_at)) }}
              </div>
            </td>
            <td class="mobilemd:px-4 px-2 py-4">
              <div  class="font-medium text-skzdark-100 space-x-4"
                ><button class="cursor-pointer" onclick="document.getElementById('view-{{ $message->slug }}').classList.remove('hidden')">
                  <span class="fa fa-eye"></span>
                </button>

                <button class="cursor-pointer">
                  <span
                    class="fa fa-trash-can text-skzdark-100"></span></button
              ></div>
            </td>
          </tr>

           <!-- Modal Background -->
          <div
            id="view-{{ $message->slug }}"
            class="fixed top-30 h-fit bottom-0 right-[50%] z-50 items-center justify-center backdrop-blur-sm drop-shadow-2xl w-8/12 mx-auto hidden">
            <!-- Modal Container -->
            <div
              class="bg-white rounded-2xl shadow-2xl w-full overflow-hidden animate-fadeIn">
              <!-- Modal Header -->
              <div
                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-skzdark-200 text-center flex-1">
                  {{ $message->title }}
                </h2>
                <button
                  class="text-skzdark-200 cursor-pointer h-6 w-6 rounded-full bg-skzyellow-100 p-1 flex items-center justify-center hover:bg-skzyellow-200 hover:text-gray-600 transition"
                  onclick="document.getElementById('view-{{ $message->slug }}').classList.add('hidden')">
                  ✕
                </button>
              </div>

              <!-- Modal Body -->
              <div class="px-6 py-4 space-y-4 text-gray-700">
                <div class="whitespace-pre-wrap">{{ $message->content }}</div>

                <div class="border-t border-gray-200 pt-3">
                  <div class="flex justify-between text-sm text-gray-500">
                    <span>Sent {{ date('d.m.Y', $message->sent_at) }}</span>
                    <span
                      >Status:
                      <span
                        class="px-2 py-0.5 rounded-full text-xs font-medium 
                    bg-{{ $message->messageStatus->color }}-100 
                    text-{{ $message->messageStatus->color }}-700">
                        {{ $message->messageStatus->statement }}
                      </span>
                    </span>
                  </div>
                </div>

                <div class="pt-3">
                  <h6 class="text-sm font-semibold mb-2">Contacts</h6>
                  <div class="flex flex-wrap gap-2">
                    @foreach($contactArr as $contact)
                    <span
                      class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs">
                      {{ $contact }}
                    </span>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- Modal Footer -->
              <div class="px-6 py-4 border-t border-gray-200 text-center">
                <button
                  class="bg-[#FFCB00] text-skzdark-200 text-base sm:px-4 px-2 laptopmd:w-2/12 sm:w-4/12 mobilelg:w-3/12 mobilemd:w-5/12 mobilesm:w-5/12 w-full h-12 rounded-lg hover:opacity-80 transition-colors cursor-pointer font-medium"
                  onclick="document.getElementById('view-{{ $message->slug }}').classList.add('hidden')">
                  <i class="fa fa-arrow-left"></i> Go back
                </button>
              </div>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>

      <nav
        class="flex items-center flex-column flex-wrap md:flex-row justify-between p-4"
        aria-label="Table navigation">
        <span
          class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto"
          >Showing
          <span class="font-semibold text-gray-900">1-10</span>
          of
          <span class="font-semibold text-gray-900">1000</span></span
        >
        <ul
          class="inline-flex space-x-2 rtl:space-x-reverse text-sm h-8 items-center">
          <li>
            <a
              href="#"
              class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-gray-700">
              <span class="mobilelg:hidden fa fa-chevron-left"></span
              ><span class="sm:block hidden">Previous</span>
            </a>
          </li>
          <li>
            <a
              href="#"
              class="flex items-center justify-center sm:px-3 px-2 sm:h-8 h-5 leading-tight text-gray-500 bg-white rounded-md hover:bg-gray-100 hover:text-gray-700"
              >1</a
            >
          </li>
          <li>
            <a
              href="#"
              class="flex items-center justify-center sm:px-3 px-2 sm:h-8 h-5 leading-tight text-gray-500 bg-white rounded-md hover:bg-gray-100 hover:text-gray-700"
              >2</a
            >
          </li>
          <li>
            <a
              href="#"
              aria-current="page"
              class="flex items-center justify-center sm:px-3 px-2 sm:h-8 h-5 text-[#FFCB00] rounded-md bg-gray-100 hover:bg-gray-200 hover:text-skzdark-200"
              >3</a
            >
          </li>
          <li>
            <a
              href="#"
              class="flex items-center justify-center sm:px-3 px-2 sm:h-8 h-5 leading-tight text-gray-500 bg-white rounded-md hover:bg-gray-100 hover:text-gray-700"
              >4</a
            >
          </li>
          <li>
            <a
              href="#"
              class="flex items-center justify-center sm:px-3 px-2 sm:h-8 h-5 leading-tight text-gray-500 bg-white rounded-md hover:bg-gray-100 hover:text-gray-700"
              >5</a
            >
          </li>
          <li>
            <a
              href="#"
              class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-200 rounded-md hover:bg-gray-100 hover:text-gray-700"
              ><span class="sm:block hidden">Next</span>
              <span
                class="mobilelg:hidden block fa fa-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
@endsection