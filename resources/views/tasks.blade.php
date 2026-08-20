<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - TaskFlow</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 antialiased">

    <!-- Top Navigation Bar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                
                <!-- Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <i class="fa-solid fa-list-check text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 tracking-tight">TaskFlow</h1>
                        <p class="text-xs text-slate-500 font-medium">Laravel 12 Dashboard</p>
                    </div>
                </div>

                <!-- User Profile & Logout -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm border border-indigo-200 uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-xs font-bold text-slate-900 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-400 font-medium">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                            title="Sign Out"
                            class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition flex items-center gap-1.5 text-xs font-semibold">
                            <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header & Stats Summary -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Welcome, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-slate-500 text-sm mt-1">Here is the overview of your personal tasks.</p>
            </div>
            
            <!-- Quick Stats -->
            <div class="flex items-center gap-3">
                <div class="bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Total</p>
                        <p id="total-count" class="text-lg font-bold text-slate-800">0</p>
                    </div>
                </div>

                <div class="bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Pending</p>
                        <p id="pending-count" class="text-lg font-bold text-slate-800">0</p>
                    </div>
                </div>

                <div class="bg-white px-4 py-2.5 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Completed</p>
                        <p id="completed-count" class="text-lg font-bold text-slate-800">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 Column Layout: Form on Left, Task List on Right -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT COLUMN: Create Task Form -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm sticky top-24">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-plus-circle text-indigo-600"></i>
                            Add New Task
                        </h3>
                    </div>

                    <form id="create-task-form" class="space-y-4">
                        <!-- Task Title Input -->
                        <div>
                            <label for="title" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                Task Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" name="title" required
                                placeholder="e.g. Finish Laravel Auth"
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition">
                        </div>

                        <!-- Task Description Input -->
                        <div>
                            <label for="description" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" name="description" rows="3" required
                                placeholder="Write task details here..."
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition resize-none"></textarea>
                        </div>

                        <!-- Task Status Select -->
                        <div>
                            <label for="status" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">
                                Initial Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status" required
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition">
                                <option value="pending">🟡 Pending</option>
                                <option value="completed">🟢 Completed</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn"
                            class="w-full mt-2 py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl text-sm shadow-md shadow-indigo-200 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Save Task
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: Task List -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm min-h-[400px]">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-list text-indigo-600"></i>
                            My Tasks
                        </h3>
                        <span id="task-badge-count" class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-full">
                            Loading...
                        </span>
                    </div>

                    <!-- Tasks Container -->
                    <div id="tasks-container" class="space-y-3">
                        <div class="text-center py-12 text-slate-400">
                            <i class="fa-solid fa-circle-notch fa-spin text-3xl mb-3 text-indigo-500"></i>
                            <p class="text-sm">Loading tasks...</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Notification Toast Container -->
    <div id="toast" class="fixed bottom-6 right-6 transform transition-all duration-300 translate-y-20 opacity-0 pointer-events-none z-50">
        <div class="bg-slate-900 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 text-sm font-medium border border-slate-700">
            <i id="toast-icon" class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
            <span id="toast-message">Action successful!</span>
        </div>
    </div>

    <!-- JavaScript to communicate with Laravel Backend API -->
    <script>
        const API_URL = '/api/tasks';
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Elements
        const tasksContainer = document.getElementById('tasks-container');
        const createTaskForm = document.getElementById('create-task-form');
        const submitBtn = document.getElementById('submit-btn');
        const totalCountEl = document.getElementById('total-count');
        const pendingCountEl = document.getElementById('pending-count');
        const completedCountEl = document.getElementById('completed-count');
        const taskBadgeCount = document.getElementById('task-badge-count');

        // Toast Helper
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');

            toastMessage.textContent = message;
            if (isError) {
                toastIcon.className = 'fa-solid fa-circle-exclamation text-rose-400 text-base';
            } else {
                toastIcon.className = 'fa-solid fa-circle-check text-emerald-400 text-base';
            }

            toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
            }, 3000);
        }

        // 1. Fetch and Display All Tasks (GET /api/tasks)
        async function fetchTasks() {
            try {
                const response = await fetch(API_URL);
                const result = await response.json();

                if (result.success) {
                    renderTasks(result.data);
                } else {
                    tasksContainer.innerHTML = `<p class="text-rose-500 text-center py-6 text-sm">Failed to load tasks.</p>`;
                }
            } catch (error) {
                console.error('Error:', error);
                tasksContainer.innerHTML = `<p class="text-rose-500 text-center py-6 text-sm">Error connecting to server.</p>`;
            }
        }

        // 2. Render Tasks on Screen
        function renderTasks(tasks) {
            const total = tasks.length;
            const pending = tasks.filter(t => t.status === 'pending').length;
            const completed = tasks.filter(t => t.status === 'completed').length;

            totalCountEl.textContent = total;
            pendingCountEl.textContent = pending;
            completedCountEl.textContent = completed;
            taskBadgeCount.textContent = `${total} Tasks`;

            if (tasks.length === 0) {
                tasksContainer.innerHTML = `
                    <div class="text-center py-16 text-slate-400 border-2 border-dashed border-slate-100 rounded-xl">
                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-slate-300"></i>
                        <h4 class="font-semibold text-slate-700 text-base">No tasks found</h4>
                        <p class="text-xs text-slate-400 mt-1">Add your first task from the left side form!</p>
                    </div>
                `;
                return;
            }

            tasksContainer.innerHTML = tasks.map(task => {
                const isCompleted = task.status === 'completed';
                const badgeClass = isCompleted 
                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                    : 'bg-amber-50 text-amber-700 border-amber-200';
                const statusDot = isCompleted ? 'bg-emerald-500' : 'bg-amber-500';
                const statusText = isCompleted ? 'Completed' : 'Pending';

                return `
                    <div class="p-4 rounded-xl border border-slate-200 bg-white hover:border-slate-300 hover:shadow-sm transition flex items-start justify-between gap-3">
                        <div class="flex items-start gap-3 flex-1 min-w-0">
                            <!-- Toggle Checkbox Button -->
                            <button onclick="toggleStatus(${task.id}, '${task.status}')" 
                                title="Mark as ${isCompleted ? 'Pending' : 'Completed'}"
                                class="mt-1 w-5 h-5 rounded-lg border flex items-center justify-center transition flex-shrink-0 ${isCompleted ? 'bg-emerald-500 border-emerald-500 text-white' : 'border-slate-300 hover:border-indigo-500 text-transparent'}">
                                <i class="fa-solid fa-check text-xs"></i>
                            </button>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold border ${badgeClass}">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full ${statusDot}"></span>
                                        ${statusText}
                                    </span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-base leading-snug break-words ${isCompleted ? 'line-through text-slate-400' : ''}">
                                    ${escapeHtml(task.title)}
                                </h4>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed break-words ${isCompleted ? 'text-slate-400' : ''}">
                                    ${escapeHtml(task.description || '')}
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-1">
                            <button onclick="deleteTask(${task.id})" 
                                title="Delete task"
                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                <i class="fa-regular fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Helper to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // 3. Handle Form Submit (POST /api/tasks)
        createTaskForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const status = document.getElementById('status').value;

            submitBtn.disabled = true;
            submitBtn.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin"></i> Saving...`;

            try {
                const response = await fetch(API_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ title, description, status })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showToast('Task added successfully! 🎉');
                    createTaskForm.reset();
                    document.getElementById('status').value = 'pending';
                    fetchTasks();
                } else {
                    showToast(result.message || 'Failed to save task', true);
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Network error while saving task', true);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = `<i class="fa-solid fa-paper-plane"></i> Save Task`;
            }
        });

        // 4. Toggle Status (PUT /api/tasks/{id})
        async function toggleStatus(id, currentStatus) {
            const newStatus = currentStatus === 'completed' ? 'pending' : 'completed';

            try {
                const response = await fetch(`${API_URL}/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                const result = await response.json();
                if (response.ok && result.success) {
                    showToast(`Marked as ${newStatus}!`);
                    fetchTasks();
                } else {
                    showToast('Failed to update status', true);
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Network error updating task', true);
            }
        }

        // 5. Delete Task (DELETE /api/tasks/{id})
        async function deleteTask(id) {
            if (!confirm('Are you sure you want to delete this task?')) return;

            try {
                const response = await fetch(`${API_URL}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const result = await response.json();
                if (response.ok && result.success) {
                    showToast('Task deleted successfully!');
                    fetchTasks();
                } else {
                    showToast('Failed to delete task', true);
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Network error deleting task', true);
            }
        }

        // Initial Load
        fetchTasks();
    </script>
</body>
</html>
