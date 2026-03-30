<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Message Details') }}
            </h2>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back to Messages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    <div class="mb-6 pb-6 border-b border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <h3 class="text-lg font-medium text-gray-200">Message from {{ $message->name }}</h3>
                                <span class="ml-4 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $message->is_read ? 'bg-green-900 text-green-200' : 'bg-blue-900 text-blue-200' }}">
                                    {{ $message->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </div>

                            <div class="text-sm text-gray-400">
                                Received: {{ $message->created_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-400">From:</h4>
                                <p class="text-base font-medium text-gray-200">{{ $message->name }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-400">Email:</h4>
                                <p class="text-base font-medium text-gray-200">{{ $message->email }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-400 mb-2">Message:</h4>
                            <div class="bg-gray-800 p-4 rounded-md">
                                <p class="text-base text-gray-200 whitespace-pre-line">{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
                            </button>
                        </form>

                        <a href="mailto:{{ $message->email }}" class="inline-flex items-center px-4 py-2 bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Reply via Email
                        </a>

                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
