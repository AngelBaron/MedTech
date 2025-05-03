<div class="flex items-center me-4">
    <input name="{{$name}}" id="{{$id}}" type="checkbox" value="{{$value}}" class="w-4 h-4 text-{{$color}}-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-{{$color}}-500 dark:focus:ring-{{$color}}-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{$id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$slot}}</label>
</div>