<!-- This example requires Tailwind CSS v2.0+ -->
<div>
    <div>
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Applicant Information
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Personal details and application.
        </p>
    </div>
    <div class="mt-5 border-t border-gray-200">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-2 sm:py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                <dt class="text-sm font-medium text-gray-500">
                    Full name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Margot Foster
                </dd>
            </div>
        </dl>
    </div>
</div>

<fieldset class="space-y-5">
    <legend class="sr-only">Progress</legend>
    <div class="relative flex items-start">
        <div class="flex items-center h-5">
            <input type="checkbox" disabled checked
                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
        </div>
        <div class="ml-3 text-sm flex flex-col sm:flex-row items-start sm:items-center sm:space-x-4">
            <label for="candidates" class="font-medium text-gray-700">Candidates</label>
            <p id="candidates-description" class="text-gray-500 not-prose">Get notified when a candidate applies for a
                job.
            </p>
        </div>
    </div>
</fieldset>
