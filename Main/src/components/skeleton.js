export function generateSkeleton() {
    return `
        <div class="flex flex-wrap p-16 h-min gap-10">
        <div class="flex gap-10">
            <div role="status"
                class="min-w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
                <div class="h-2.5 bg-gray-700 rounded-full  w-32 mb-2.5"></div>
                <div class="w-48 h-2 mb-10 bg-gray-700 rounded-full "></div>
                <div class="flex items-baseline mt-4">
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 "></div>
                    <div class="w-full h-56 ms-6 bg-gray-700 rounded-t-lg "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 ms-6 "></div>
                    <div class="w-full h-64 ms-6 bg-gray-700 rounded-t-lg "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-80 ms-6 "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 ms-6 "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-80 ms-6 "></div>
                </div>
                <span class="sr-only">Loading...</span>
            </div>

            <div role="status"
                class="min-w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
                <div class="h-2.5 bg-gray-700 rounded-full  w-32 mb-2.5"></div>
                <div class="w-48 h-2 mb-10 bg-gray-700 rounded-full "></div>
                <div class="flex items-baseline mt-4">
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 "></div>
                    <div class="w-full h-56 ms-6 bg-gray-700 rounded-t-lg "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 ms-6 "></div>
                    <div class="w-full h-64 ms-6 bg-gray-700 rounded-t-lg "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-80 ms-6 "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-72 ms-6 "></div>
                    <div class="w-full bg-gray-700 rounded-t-lg h-80 ms-6 "></div>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div role="status"
            class="min-w-full p-4 space-y-4 border border-gray-200 divide-y divide-gray-200 rounded shadow animate-pulse dark:divide-gray-700 md:p-6 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>

        <div role="status"
            class="space-y-8 animate-pulse md:space-y-0 md:space-x-8 rtl:space-x-reverse md:flex md:items-center">
            <div class="flex items-center justify-center w-full h-64 bg-gray-800 rounded sm:w-96 ">
                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path
                        d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                </svg>
            </div>
            <div class="w-full">
                <div class="h-2.5 bg-gray-700 rounded-full  w-48 mb-4"></div>
                <div class="h-2 bg-gray-700 rounded-full  max-w-[480px] mb-2.5"></div>
                <div class="h-2 bg-gray-700 rounded-full  mb-2.5"></div>
                <div class="h-2 bg-gray-700 rounded-full  max-w-[440px] mb-2.5"></div>
                <div class="h-2 bg-gray-700 rounded-full  max-w-[460px] mb-2.5"></div>
                <div class="h-2 bg-gray-700 rounded-full  max-w-[360px]"></div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>

        <div role="status"
            class="min-w-full p-4 space-y-4 border border-gray-200 divide-y divide-gray-200 rounded shadow animate-pulse dark:divide-gray-700 md:p-6 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <div class="flex items-center justify-between pt-4">
                <div>
                    <div class="h-2.5 bg-gray-800 rounded-full  w-24 mb-2.5"></div>
                    <div class="w-32 h-2 bg-gray-700 rounded-full "></div>
                </div>
                <div class="h-2.5 bg-gray-800 rounded-full  w-12"></div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    `
}