

function setFullscreenImg(){
    //Temporary fix as src is undefined for this element when set by blade
    (document.getElementById('fullScreenImage') as HTMLImageElement).src = (document.getElementById('img1') as HTMLImageElement).src; 
}
function productScrollHandler() {
    const smallImgs = document.querySelectorAll(
        ".small-img"
    ) as NodeListOf<HTMLImageElement>;
    document.querySelectorAll(".scrollable").forEach((e) => {
        e.scrollLeft = 0;
    });
    function resetImgs() {
        const prevSmallActiveImg = document.querySelector(".small-active");

        console.log(prevSmallActiveImg);
        prevSmallActiveImg?.parentElement!.classList.replace(
            "-translate-y-1",
            "-translate-y-0"
        );
        prevSmallActiveImg?.classList.add("opacity-50");
        prevSmallActiveImg?.classList.remove("small-active");

        const prevBigActiveImg = document.querySelector(".big-active");
        prevBigActiveImg?.classList.remove("big-active");
        prevBigActiveImg?.classList.add("opacity-50");
    }
    smallImgs.forEach((element) => {
        element.addEventListener("click", (e) => {
            resetImgs();
            const target = e.target as HTMLImageElement;
            const imageNumber = target.id[1];
            target.classList.add("small-active");
            target.parentElement!.classList.replace(
                "-translate-y-0",
                "-translate-y-1"
            );
            target.classList.remove("opacity-50");
            const newBigActiveImg = document.getElementById("b" + imageNumber)!;
            console.log("b" + target.id);
            console.log(newBigActiveImg);
            newBigActiveImg.classList.add("big-active");
            newBigActiveImg.classList.remove("opacity-50");
            (
                document.getElementById("fullScreenImage") as HTMLImageElement
            ).src = (newBigActiveImg.children[0] as HTMLImageElement).src;
            const prevBigActiveImg = document.querySelector(".big-active");
            const scrollWidth = prevBigActiveImg!.getBoundingClientRect().width;
            document.getElementById("big-images-scrollable")!.scrollLeft =
                scrollWidth * Number(newBigActiveImg.id[1]);
        });
    });
}
const productZoomHandler = () => {
    if (window.innerWidth < 640) return;

    const containers = document.querySelectorAll(".big-img")!;

    containers.forEach((imgContainer) => {
        const image = imgContainer.children[0] as HTMLImageElement;
        image.addEventListener("mousemove", (event) => {
            const e = event as MouseEvent;
            const { left, top, width, height } =
                imgContainer.getBoundingClientRect();
            const imgWidth = image.getBoundingClientRect().width;
            const mouseX = e.clientX - left;
            const mouseY = e.clientY - top;
            const percentX = (mouseX / width) * 100;
            const percentY = (mouseY / height) * 100;

            // Adjust these values for different zoom levels

            image.style.transformOrigin = `${percentX}% ${percentY}%`;
            image.style.transform = "scale(2)"; // Zoom factor (1.5x)
        });

        image.addEventListener("mouseleave", () => {
            image.style.transform = "scale(1)"; // Reset zoom
        });
    });
};
const TouchZoomHandler = () => {
    const thumbnail = document.getElementById("fullscreen-icon")!;
    const fullScreenModal = document.getElementById("fullScreenModal")!;
    const closeButton = document.getElementById("closeButton")!;
    const imgSrc = (document.querySelector('.big-active') as HTMLImageElement).src;
    (document.getElementById('fullScreenImage') as HTMLImageElement).src = imgSrc;
    let isFullscreen = false;
    // Show full screen image
    thumbnail.addEventListener("click", () => {
        console.log("clicked");
        isFullscreen = true;
        history.pushState({ fullscreen: true }, "");
        document.querySelector("body")?.classList.add("overflow-y-hidden");
        fullScreenModal.classList.replace("hidden", "flex");
    });

    //Close using back button
    window.addEventListener("popstate", () => {
        console.log("popstate: ", isFullscreen);

        if (isFullscreen) {
            document
                .querySelector("body")
                ?.classList.remove("overflow-y-hidden");
            fullScreenModal.classList.replace("flex", "hidden");
        }
    });
    // Close full screen image
    closeButton.addEventListener("click", () => {
        document.querySelector("body")?.classList.remove("overflow-y-hidden");
        fullScreenModal.classList.replace("flex", "hidden");
        history.back();
    });

    // Close the modal if clicked outside the image
    fullScreenModal.addEventListener("click", (e) => {
        if (e.target === fullScreenModal) {
            document
                .querySelector("body")
                ?.classList.remove("overflow-y-hidden");
            fullScreenModal.classList.replace("flex", "hidden");
            history.back();
        }
    });
};
function missingImgHandler() {
    document.querySelectorAll('.product-img').forEach((element) => {
        element.addEventListener('error', () => {
            element.parentElement!.classList.add('hidden')
        })
    })
}
const orderHandler = () => {

    function orderCountHandler() {
        const decrementButton = document.getElementById("decrement")!;
        const incrementButton = document.getElementById("increment")!;
        const numberDisplay = document.getElementById("quantity")!;

        decrementButton.addEventListener("click", () => {
            if (count > 1) {
                count--;
                numberDisplay.textContent = JSON.stringify(count);
            }
        });

        incrementButton.addEventListener("click", () => {
            count++;
            numberDisplay.textContent = JSON.stringify(count);
        });
    };
    function sendOrderHandler() {
        document.getElementById('order-form')?.addEventListener('submit', async (e: SubmitEvent) => {
            e.preventDefault();
            const target = e.target as any;
            const submitBtn = document.getElementById('submit-btn') as HTMLButtonElement;
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending Order..';

            try {
                const submission = new FormData();

                submission.append("Name", target.elements.fullName.value);
                submission.append("Address", target.elements.address.value);
                submission.append("PhoneNumber", target.elements.phoneNumber.value);
                submission.append("Products", JSON.stringify([{ id: bladeProduct.id, quantity: count }]));

                const options: RequestInit = {
                    method: "POST",
                    headers: {
                        "Access-Control-Allow-Credentials": "true",
                        //without decoding, %3D in token isn't converted to =, which causes token mismatch

                        Accept: "multipart/form-data",
                    },
                    credentials: "include",
                    body: submission,
                };

                target.reset();
                const endpoint = location.protocol + "//" + location.host + "/_api/order/";

                const res = await fetch(endpoint, options);
                if (res.status === 200) {
                    submitBtn.innerHTML = 'Order Sent.';
                } else {
                    submitBtn.innerHTML = 'Failed to send order: ' + res.status;
                    submitBtn.disabled = false;

                }
            } catch (e) {

                submitBtn.innerHTML = 'Failed to send order: Unknown Error';
                submitBtn.disabled = false;
                throw (e);
            }

        })
    }
    const orderWindow = document.getElementById('order-popup')!;
    //vite build redeclares count causing redeclaration error, 
    const countCopy = count;
    document.getElementById('close-order')?.addEventListener('click', () => {
        orderWindow.classList.add('hidden')
    })
    document.getElementById('order-overlay')?.addEventListener('click', () => {
        orderWindow.classList.add('hidden')
    })
    document.getElementById('buy-button')?.addEventListener('click', () => {
        document.getElementById('order-count')!.innerHTML = JSON.stringify(countCopy)
        document.getElementById('order-price')!.innerHTML = JSON.stringify((bladeProduct.discounted_price ? bladeProduct.discounted_price : bladeProduct.price) * count);

        orderWindow?.classList.remove('hidden')

    })
    sendOrderHandler();
    orderCountHandler();

}
//@ts-ignore
const bladeProduct = phpProduct;
let count = 1;

orderHandler();
productZoomHandler();
productScrollHandler();
TouchZoomHandler();
missingImgHandler();
setFullscreenImg();