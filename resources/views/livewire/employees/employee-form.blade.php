<div>
 
<div class="min-h-screen bg-slate-100 py-10 px-4">
  <!-- Background decoration -->
  <div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-100 rounded-full opacity-60 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-indigo-100 rounded-full opacity-50 blur-3xl"></div>
  </div>

  <a href="{{ route('home') }}" 
    class="absolute top-6 left-6 flex items-center gap-2 text-black/50 hover:text-black transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="text-sm font-medium">Back</span>
    </a>

  <div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600 mb-4">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
      </div>
      <h1 class="text-2xl font-semibold text-slate-800 tracking-tight">Employee Registration</h1>
      <p class="text-sm text-slate-500 mt-1">Complete all fields to register a new employee record</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

      <!-- Section: Personal Information -->
      <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
        <h2 class="text-xs font-600 font-semibold text-slate-400 uppercase tracking-widest">Personal Information</h2>
      </div>
      <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">ID No.</label>
          <input type="text" wire:model="empId" placeholder="e.g. EMP-0001" autofocus
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
            @error('empId')
                <small class="text-red-500">{{ $message }}</small>
            @enderror   
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Date of Birth</label>
          <input type="date" wire:model="dob"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">First Name</label>
          <input type="text" wire:model="fname" placeholder="Enter first name"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Middle Name</label>
          <input type="text" wire:model="mname" placeholder="Enter middle name"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Last Name</label>
          <input type="text" wire:model="lname" placeholder="Enter last name"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

         <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Suffix</label>
          <input type="text" wire:model="suffix" placeholder="Enter suffix"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Civil Status</label>
          <select wire:model="status"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none">
            <option value="" disabled selected>Select status</option>
            <option>Single</option>
            <option>Married</option>
            <option>Widowed</option>
            <option>Separated</option>
          </select>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Position</label>
          <input type="text" wire:model="position" placeholder="Enter position"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1 sm:col-span-2">
          <label class="text-xs font-medium text-slate-500">Address</label>
          <input type="text" wire:model="address" placeholder="Enter full address"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

      </div>

      <!-- Section: Government IDs -->
      <div class="px-6 py-4 bg-slate-50 border-y border-slate-200">
        <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Government IDs</h2>
      </div>
      <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">SSS No.</label>
          <input type="text" wire:model="sss_no" placeholder="XX-XXXXXXX-X"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">PhilHealth (PHIC)</label>
          <input type="text" wire:model="philhealth_no" placeholder="XXXX-XXXX-XXXX"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Pag-IBIG (HDMF)</label>
          <input type="text" wire:model="pagibig_no" placeholder="XXXX-XXXX-XXXX"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

      </div>

      <!-- Section: Emergency Contact -->
      <div class="px-6 py-4 bg-slate-50 border-y border-slate-200">
        <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Emergency Contact</h2>
      </div>
      <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">EC Name</label>
          <input type="text" wire:model="contact_name" placeholder="Enter emergency contact name"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">EC Number</label>
          <input type="text" wire:model="contact_number" placeholder="Enter emergency contact number"
            class="h-10 px-3 rounded-lg border border-slate-200 text-sm text-slate-800 bg-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"/>
        </div>

      </div>

      <!-- Section: Documents -->
      <div class="px-6 py-4 bg-slate-50 border-y border-slate-200">
        <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Documents & Media</h2>
      </div>
      <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Profile Picture</label>
          <input type="file" wire:model="picture_path" accept="image/*"
            class="text-sm text-slate-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border file:border-slate-200 file:text-xs file:font-medium file:text-slate-600 file:bg-slate-50 hover:file:bg-slate-100 file:cursor-pointer cursor-pointer"/>
        </div>

        <div class="flex flex-col gap-1">
          <label class="text-xs font-medium text-slate-500">Signature</label>
          <input type="file" wire:model="signature_path" accept="image/*"
            class="text-sm text-slate-500 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border file:border-slate-200 file:text-xs file:font-medium file:text-slate-600 file:bg-slate-50 hover:file:bg-slate-100 file:cursor-pointer cursor-pointer"/>
        </div>

      </div>

      <!-- Actions -->
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between gap-3">
        <button type="button"
          class="text-sm text-slate-400 hover:text-slate-600 transition">
          Clear form
        </button>
        <div class="flex gap-3">
          <button type="button"
            class="h-10 px-5 rounded-lg border border-slate-200 text-sm font-medium text-slate-600 bg-white hover:bg-slate-50 transition">
            Save Draft
          </button>
          
            <button wire:click="save">
                {{ $isEditing ? 'Save Changes' : 'Register Employee' }}
            </button>

        </div>
      </div>

    </div>

    <p class="text-center text-xs text-slate-400 mt-6">All fields are required unless marked optional.</p>
  </div>

</div>
</div>