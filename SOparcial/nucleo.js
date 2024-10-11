let processCount = 0;
let runningProcesses = 0;
const maxProcesses = 10;
let processes = [];
let usedMemory = 0;
let executingProcessId = null;
let processRunning = false;
let continuousExecution = false; 

function updateResources() {
    
    const cpuUsage = maxProcesses > 0 ? Math.max(0, (runningProcesses / maxProcesses) * 100) : 0;
    document.getElementById('cpuUsage').textContent = `${cpuUsage.toFixed(2)}%`;
    document.getElementById('memoryUsage').textContent = `${usedMemory} MB`;
}

function createProcess() {
    if (processCount >= maxProcesses) {
        alert("Se ha alcanzado el número máximo de procesos.");
        return;
    }

    const memoryUsage = Math.floor(Math.random() * 150) + 50;
    if (usedMemory + memoryUsage > 1024) {
        alert("No hay suficiente memoria para este proceso.");
        return;
    }
    usedMemory += memoryUsage;

    processCount++;
    const priorityNumber = Math.floor(Math.random() * 5) + 1;
    let priorityText = 'Muy Baja'; // Default priority
    switch (priorityNumber) {
        case 1:
            priorityText = 'Urgente';
            break;
        case 2:
            priorityText = 'Alta';
            break;
        case 3:
            priorityText = 'Media';
            break;
        case 4:
            priorityText = 'Baja';
            break;
        case 5:
            priorityText = 'Muy Baja';
            break;
    }

    const newProcess = { id: processCount, state: 'new', priority: priorityText, memory: memoryUsage, hasBeenBlocked: false };
    processes.push(newProcess);

    const processContainer = document.getElementById('processContainer');
    const row = document.createElement('tr');
    row.id = `process${processCount}`;
    row.classList.add('new');

    row.innerHTML = `
        <td>${processCount}</td>
        <td>Nuevo</td>
        <td>${priorityText}</td>
        <td>${memoryUsage} MB</td>
        <td class="process-actions">
            <button class="btn btn-danger btn-delete" onclick="deleteProcess(${processCount})">Eliminar</button>
        </td>
    `;
    processContainer.appendChild(row);
    updateResources();

    if (processRunning) {
        processes.sort((a, b) => priorityOrder[b.priority] - priorityOrder[a.priority]); // Reordenar por prioridad
        handlePriority();
    }
}

function deleteProcess(processId) {
    const process = processes.find(p => p.id === processId);
    const processRow = document.getElementById(`process${processId}`);

    
    usedMemory -= process.memory;

    
    processRow.remove();

    
    processes = processes.filter(p => p.id !== processId);

    
    if (executingProcessId === processId) {
        executingProcessId = null;
        
        executeNextProcess();
    } else if (process.state === 'running') {
        runningProcesses--;
    }

    updateResources();
}

function startProcess(processId) {
    const process = processes.find(p => p.id === processId);
    const processRow = document.getElementById(`process${processId}`);

    if (process.state === 'zombie' || processRow.classList.contains('running') || processRow.classList.contains('blocked')) {
        return;
    }

    if (processRow.classList.contains('new')) {
        processRow.classList.remove('new');
        processRow.classList.add('ready');
        processRow.cells[1].textContent = "Listo";

        setTimeout(() => {
            processRow.classList.remove('ready');
            processRow.classList.add('running');
            processRow.cells[1].textContent = "Ejecutando";

            runningProcesses++;
            process.state = 'running';
            executingProcessId = processId;
            updateResources();

            setTimeout(() => {
                if (process.hasBeenBlocked) {
                    terminateProcess(processId);
                } else if (Math.random() < 0.3) {
                    processRow.classList.remove('running');
                    processRow.classList.add('blocked');
                    processRow.cells[1].textContent = "Bloqueado";
                    process.state = 'blocked';
                    process.hasBeenBlocked = true;

                    setTimeout(() => {
                        unblockProcess(processId);
                    }, 1000);
                } else {
                    terminateProcess(processId);
                }
            }, 1000);
        }, 1000);
    }
}

function unblockProcess(processId) {
    const process = processes.find(p => p.id === processId);
    const processRow = document.getElementById(`process${processId}`);

    processRow.classList.remove('blocked');
    processRow.classList.add('ready');
    processRow.cells[1].textContent = "Listo";

    setTimeout(() => {
        processRow.classList.remove('ready');
        processRow.classList.add('running');
        processRow.cells[1].textContent = "Ejecutando";

        runningProcesses++;
        process.state = 'running';
        updateResources();

        setTimeout(() => {
            terminateProcess(processId);
        }, 1000);
    }, 1000);
}

function terminateProcess(processId) {
    const process = processes.find(p => p.id === processId);
    const processRow = document.getElementById(`process${processId}`);

    if (process.state === 'zombie') {
        return;
    }

    if (Math.random() < 0.1) {
        processRow.classList.remove('new', 'ready', 'running', 'blocked');
        processRow.classList.add('zombie');
        processRow.cells[1].textContent = "Zombie";
        process.state = 'zombie';
        disableProcessActions(processId);
        executingProcessId = null;
        executeNextProcess();
        return;
    }

    processRow.classList.remove('new', 'ready', 'running', 'blocked');
    processRow.classList.add('finished');
    processRow.cells[1].textContent = "Terminado";

    usedMemory -= process.memory;
    runningProcesses--;

    disableProcessActions(processId);
    executingProcessId = null;
    executeNextProcess();
    updateResources();
}

function disableProcessActions(processId) {
    const processRow = document.getElementById(`process${processId}`);
    const buttons = processRow.querySelectorAll('.process-actions button');
    buttons.forEach(button => button.disabled = false); 
}

function clearProcesses() {
    document.getElementById('processContainer').innerHTML = '';
    processes = [];
    processCount = 0;
    runningProcesses = 0;
    usedMemory = 0;
    executingProcessId = null;
    processRunning = false;
    continuousExecution = false; 
    updateResources();
}

function runAllProcesses() {
    processes.sort((a, b) => priorityOrder[b.priority] - priorityOrder[a.priority]);
    processRunning = true;
    continuousExecution = true; 
    executeNextProcess();
}

function executeNextProcess() {
    if (executingProcessId === null && processes.length > 0 && continuousExecution) {
        processes.sort((a, b) => priorityOrder[b.priority] - priorityOrder[a.priority]);
        const nextProcess = processes.find(p => p.state === 'new' || p.state === 'ready');

        if (nextProcess) {
            startProcess(nextProcess.id);
        }
    }
}

function resumeProcess(processId) {
    const processRow = document.getElementById(`process${processId}`);
    if (processRow.classList.contains('ready')) {
        startProcess(processId);
    }
}

const priorityOrder = {
    'Urgente': 5,
    'Alta': 4,
    'Media': 3,
    'Baja': 2,
    'Muy Baja': 1
};

function handlePriority() {
    
    processes.sort((a, b) => priorityOrder[b.priority] - priorityOrder[a.priority]);

   
    const highestPriorityProcess = processes[0];
    if (highestPriorityProcess && executingProcessId && priorityOrder[processes.find(p => p.id === executingProcessId).priority] < priorityOrder[highestPriorityProcess.priority]) {
        
        const lowestPriorityProcess = processes.find(p => p.id === executingProcessId);
        if (lowestPriorityProcess && lowestPriorityProcess.state === 'running') {
            terminateProcess(lowestPriorityProcess.id); 
        }

        
        startProcess(highestPriorityProcess.id);
    }
}
