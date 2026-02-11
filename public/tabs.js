const tabs = document.getElementsByClassName("tab")
const tabsContent = document.getElementsByClassName("tab-content")
function desactivarTodasTabs() {
    for (let i = 0; i < tabs.length; i++) {
        tabs.item(i).classList.remove("active");
        tabsContent.item(i).classList.remove("active");
    }
}

for (let i = 0; i < tabs.length; i++) {
    tabs.item(i).addEventListener("click", () => {
        desactivarTodasTabs()
        tabs.item(i).classList.add("active")
        tabsContent.item(i).classList.add("active")
    })
}