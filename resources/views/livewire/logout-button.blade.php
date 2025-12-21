<div>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item mb-1">
            <button wire:click="logout" wire:loading.attr="disabled" wire:navigate
                class="nav-link logout text-black mt-auto text-start mb-2 w-100">
                <i class="bi bi-box-arrow-right me-2"></i><span class="linkTitles"> Log Out</span>

                <span wire:loading class="spinner-border spinner-border-sm ms-2" role="status"></span>
            </button>
        </li>
    </ul>
</div>
