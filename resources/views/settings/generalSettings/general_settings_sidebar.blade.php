<div class="list-group list-group-flush account-settings-links">
    {{-- <a class="list-group-item list-group-item-action" href="{{route('project.settings', $id)}}">General Settings</a> --}}
     <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'settings') ? 'active' : '' }}" href="settings">General Settings</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'member') ? 'active' : '' }} " href="member">Members</a>

    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'issuetype') ? 'active' : '' }}" href="issuetype">Issue Type</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'category') ? 'active' : '' }}" href="category">Cetegory</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'version') ? 'active' : '' }}"  href="version">Version</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'priority') ? 'active' : '' }}"  href="priority">Priority</a>
    <a class="list-group-item list-group-item-action {{ (request()->segment(3) == 'status') ? 'active' : '' }}"  href="status">Status</a>
  </div>


 