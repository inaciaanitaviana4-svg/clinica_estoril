const tabs = document.getElementsByClassName("tab")
const tabsContent = document.getElementsByClassName("tab-content")
const tabActual = new URLSearchParams(window.location.search).get("tab")

if (tabActual !== null) {
   desactivarTodasTabs()
    tabs.item(tabActual).classList.add("active")
    tabsContent.item(tabActual).classList.add("active")
}
function desactivarTodasTabs() {
    for (let i = 0; i < tabs.length; i++) {
        tabs.item(i).classList.remove("active");
        tabsContent.item(i).classList.remove("active");
    }
}

for (let i = 0; i < tabs.length; i++) {
    tabs.item(i).addEventListener("click", (e) => {
        e.preventDefault()
        desactivarTodasTabs()
        tabs.item(i).classList.add("active")
        tabsContent.item(i).classList.add("active")
        const url = new URL(window.location.href)
        url.searchParams.set("tab", i)
        url.searchParams.delete("page")
        window.history.pushState({path: url.href}, "", url.href)
    })
}
