<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">URL Shortener</div>
                    <div class="card-body bg-dark">
                        <h4 class="card-title text-white">
                            Paste the URL to be shortened
                        </h4>
                        <form @submit.prevent="shortenUrl" class="my-4">
                            <div class="input-group">
                                <input
                                    type="text"
                                    id="p1"
                                    placeholder="Put Url here"
                                    v-model="url"
                                    class="form-control addUrlInput"
                                />
                            </div>
                            <div v-if="!urlNotFound">
                                <small class="text-danger"
                                    >Url is not Valid</small
                                >
                            </div>
                            <div class="copyLink">
                                <span id="output_url"></span>
                                <span
                                    id="clipBoard"
                                    v-on:click.prevent="copyContent"
                                >
                                    {{ copyTextString }}
                                </span>
                            </div>
                            <div>
                                <button
                                    class="btn btn-primary mt-2"
                                    v-on:click.prevent="shortenUrl"
                                    type="submit"
                                >
                                    Process Url
                                </button>
                            </div>
                        </form>
                        <p class="card-text text-white">
                            mini-link is a free tool to shorten URLs and
                            generate short links URL shortener allows to create
                            a shortened link making it easy to share
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        Professinal Url Shortener, Free and Advanced...
                    </div>
                </div>
                <div class="faq">
                    <h4>Simple and fast URL shortener!</h4>
                    <p>
                        <mark> Mini-Link</mark> allows to shorten long links
                        from
                        <u
                            >Instagram, Facebook, YouTube, Twitter, Linked In,
                            WhatsApp, TikTok, blogs and sites.</u
                        >
                        Just paste the long URL and click the Shorten URL
                        button. On the next page, copy the shortened URL and
                        share it on sites, chat and emails. After shortening the
                        URL, check how many clicks it received.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title float-start">Top 5 Visited</h4>
                        <img
                            class="card-img-top img-fluid w-25 float-end"
                            :src="getImage()"
                            alt="Card image cap"
                        />
                    </div>
                    <ol class="list-group list-group-numbered">
                        <li
                            v-for="mostVisitedURL in mostVisitedURLs"
                            :key="mostVisitedURL.id"
                            class="list-group-item d-flex justify-content-between align-items-start"
                        >
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    <a
                                        :href="mostVisitedURL.short_url"
                                        target="_blank"
                                        ><small
                                            >{{
                                                mostVisitedURL.long_url.slice(
                                                    0,
                                                    35
                                                )
                                            }}{{
                                                mostVisitedURL.long_url.length >
                                                35
                                                    ? "..."
                                                    : ""
                                            }}</small
                                        ></a
                                    >
                                </div>
                                {{ mostVisitedURL.short_url }}
                            </div>
                            <span class="badge bg-primary rounded-pill">{{
                                mostVisitedURL.click_count
                            }}</span>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h4>Last Views Links</h4>
                        <ol class="list-group list-group-numbered">
                            <li
                                v-for="url in urls"
                                :key="url.id"
                                class="list-group-item d-flex justify-content-between align-items-start"
                            >
                                <div class="ms-2 me-auto">
                                    <a :href="url.short_url" target="_blank">{{
                                        url.long_url
                                    }}</a>
                                    <br />
                                    <small>{{ url.short_url }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill"
                                    >({{ url.click_count }} clicks)</span
                                >
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    mounted() {
        console.log("Component mounted.");
    },
    props: ["AuthorizedUser"],
    data() {
        return {
            url: null,
            urlNotFound: true,
            copyTextString: "Copy Text To Clipboard",
            response: null,
            urls: [],
        };
    },
    methods: {
        getImage() {
            return "img/logo.png";
        },
        shortenUrl() {
            let self = this;
            let newUrl = self.url;
            let newArray = newUrl.split("//");
            let counter = 0;
            let resultNewUrl = Math.round(
                Math.pow(36, 8) - Math.random() * Math.pow(36, 8)
            )
                .toString(36)
                .slice(1);

            for (let i = 0; i < newArray.length; i++) {
                if (newArray[i] == "http:" || newArray[i] == "https:") {
                    counter++;
                }

                if (counter == 0) {
                    let newArrayOne = newUrl.split(".");
                    if (newArrayOne[i] == "www") {
                        counter++;
                    }

                    let newArrayTwo = newUrl.indexOf(".com");
                    if (newArrayTwo >= 0) {
                        counter++;
                    }
                }

                if (counter == 0) {
                    self.urlNotFound = false;
                } else {
                    let currentUrl = window.location.href + "u/" + resultNewUrl;
                    // console.log(currentUrl);
                    axios
                        .post("/url/shorten", {
                            url: newUrl,
                            shortlink: currentUrl,
                        })
                        .then(function (response) {
                            self.response = response.data;
                            $(".copyLink").fadeIn(500);
                            $(".copyLink")
                                .siblings(".form")
                                .find("#p1")
                                .val(self.response);
                            self.url = self.response;

                            this.fetchURLs();
                        })
                        .catch(function (error) {
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log("Error", error.message);
                            }
                            console.log(error.config);
                        });
                }
            }
        },

        copyContent() {
            $("#p1").select();
            this.copyTextString = "Url Coppied Successfully";
            document.execCommand("copy");
            this.url = this.response;
        },

        async fetchURLs() {
            axios
                .get("/urls")
                .then((response) => {
                    this.urls = response.data.urls;
                    this.fetchURLs();
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        async fetchTopURLs() {
            try {
                const response = await axios.get("/top-urls");
                this.mostVisitedURLs = response.data.mostVisitedURLs;
            } catch (error) {
                console.error(error);
            }
        },
    },
    async created() {
        try {
            const [urlsResponse, topURLsResponse] = await Promise.all([
                axios.get("/urls"),
                axios.get("/top-urls"),
            ]);

            this.urls = urlsResponse.data.urls;
            this.mostVisitedURLs = topURLsResponse.data.mostVisitedURLs;
        } catch (error) {
            console.error(error);
        }
    },
};
</script>
<style scoped>
.copyLink {
    display: none;
}

#clipBoard {
    margin-top: 0px;
    color: #02ff57;
    font-weight: 900;
    font-size: 11px;
    cursor: pointer;
}

#clipBoard:hover {
    background-color: #333;
}

#clipBoard:visited,
#clipBoard:active,
#clipBoard:focus {
    background-color: green;
    color: #333;
}
.faq {
    margin-top: 20px;
}
.faq h4 {
    font-weight: 900;
}
.faq p {
    font-size: 14px;
}
</style>
