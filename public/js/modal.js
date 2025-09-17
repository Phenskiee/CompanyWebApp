// function setModal() {
//     const viewBtn = document.getElementById('viewDetails');
//     const closBtn = document.getElementById('closeDetails');
//     const viewContainer = document.getElementById('detailsContainer');

//     viewBtn.addEventListener('click', () => {
//         viewContainer.style.display = 'block';
//     });

//     closBtn.addEventListener('click', () => {
//         viewContainer.style.display = 'none';
//     });

//     window.addEventListener('click', (e) => {
//         if(e.target === viewContainer) {
//             viewContainer.style.display = 'none';
//         }
//     })
// }
// setModal()

class setModal
{
    constructor(openBtnId, closeBtnId, containerId) {
        this.openContainer = document.getElementById(openBtnId);
        this.closeContainer = document.getElementById(closeBtnId);
        this.container = document.getElementById(containerId);

        this.openContainer.addEventListener('click', () => {
            this.open();
        });

        this.closeContainer.addEventListener('click', () => {
            this.close();
        });

        window.addEventListener('click', (e) => {
        if(e.target === this.container) {
            this.close();
        }
    })
    }

    open() {
        this.container.style.display = 'flex';
    }
    close() {
        this.container.style.display = 'none';
    }
}
const modalDetails = new setModal('viewDetails', 'closeDetails', 'detailsContainer');

const modalForm = new setModal('openForm', 'closeForm', 'formContainer');

// const infoModal = new setModal('openInfo', 'infoContainer', 'closeInfo')
