<div class="row mb-4">
    <div>
        <span class="filter-parent me-3 d-flex">
            <span class="filter-label"><strong>Search</strong></span>
            <input id="noteSearch" class="filter-input form-control modal_input" style="margin-right: 15px;" type="text"  placeholder="Search..." onkeyup="filterNotesAndSearch()">
            <span class="filter-label"><strong>Category</strong></span>
            <select class="filter-input form-control modal_input" id="noteFilter" data-trigger onchange="filterNotesAndSearch()">
                <option value="all">All</option>
                <option value="normal">Notes</option>
                <option value="error">Important Notes</option>
                <option value="danger">Reminders</option>
            </select>
        </span>
        <span id="visibleCount" class="note_posted text-dark float-right">Feed Results: <?= count($notes_view) + 1; ?></span>
    </div>
</div>
<script>
    function filterNotesAndSearch() {
        var filter = document.getElementById("noteFilter").value.toLowerCase();
        var searchQuery = document.getElementById("noteSearch").value.toLowerCase();
        var notes = document.getElementsByClassName("note");
        var visibleCount = 0;
        for (var i = 0; i < notes.length; i++) {
            var note = notes[i];
            var noteText = note.innerText.toLowerCase();
            if (note.classList.contains('all')) {
                note.style.display = "block";
                visibleCount++;
            } else if (filter === "all" || note.classList.contains(filter)) {
                if (noteText.includes(searchQuery)) {
                    note.style.display = "block";
                    visibleCount++;
                } else {
                    note.style.display = "none";
                }
            } else {
                note.style.display = "none";
            }
        }
        document.getElementById("visibleCount").innerText = "Visible Notes: " + visibleCount;
    }
</script>
