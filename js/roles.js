let roleCount = 1;

function addRole() {
    roleCount++;
    const rolesDiv = document.getElementById('roles');

    const roleHtml = `
        <div class="row g-3 align-items-center" id="role${roleCount}">
            <div class="col-md-4">
                <label for="character${roleCount}" class="form-label"></label>
                <input class="form-control border border-dark mb-1" type="text" id="character${roleCount}" placeholder="Personnage" name="character[]" required>
            </div>
            <div class="col-md-4">
                <label for="name${roleCount}" class="form-label"></label>
                <input class="form-control border border-dark mb-1" type="text" id="name${roleCount}" placeholder="Nom" name="name[]" required>
            </div>
            <div class="col-md-4">
                <label for="firstname${roleCount}" class="form-label"></label>
                <input class="form-control border border-dark mb-1" type="text" id="firstname${roleCount}" placeholder="Prénom" name="firstname[]" required>
            </div>
            <button class="btn btn-danger mt-1" type="button" onclick="removeRole(${roleCount})">Supprimer</button>
        </div>
    `;

    const roleElement = document.createElement('div');
    roleElement.innerHTML = roleHtml;
    rolesDiv.appendChild(roleElement);
}

function removeRole(roleId) {
    const roleToRemove = document.getElementById('role' + roleId);
    roleToRemove.parentNode.removeChild(roleToRemove);
}
