import React, { Component } from 'react';
import Pagination from 'react-js-pagination';
import { TitleSource } from '../teleporters/Title'
import './ArticleList.scss';
import { Link } from 'react-router-dom';
import axios from 'axios';

class ArticleList extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            pagination : [],
            activePage: 1
        };
    }

    handlePageChange(pageNumber) {
        axios.get(process.env.MIX_API_URL+'/api/article?page='+pageNumber, ) //
        .then(res => {
            this.setState({
                isLoaded: true,
                pagination: res.data,
                activePage: pageNumber,
            });
        })
        .catch (error => {
            this.setState({
                isLoaded: true,
                error: error.response.statusText
            });
        });
    }

    componentDidMount() {
        this.handlePageChange(this.state.activePage);
    }

    render() {
        const { error, isLoaded, pagination } = this.state;
        if (error) {
          return <div className="alert alert-danger"> Error: {error} </div>;
        } else if (!isLoaded) {
          return <div>Loading...</div>;
        } else {
            const TEXT_LIMIT = 200;
            const articles = pagination.data.map(article => {
                const text = article.body.length > TEXT_LIMIT ? article.body.substring(0, TEXT_LIMIT)+"..." : article.body;
                return (
                    <Link to={"/article/"+article.slug} className="app-article">
                        <div className="app-article-title">{article.name}</div>
                        <div className="app-article-sub-info">
                            <span className="app-article-date">{article.created_at}</span>|<span className="app-article-tags">{article.tags}</span>
                        </div>
                        <div className="app-article-body">
                            {text}
                        </div>
                    </Link>
                );
            });

            return (
                <>
                    <TitleSource>
                        Blog
                            <Link to="/article-add" className="app-add-article">
                                <i className="fas fa-plus-circle">
                                </i>
                                <span>Add Article</span>
                            </Link>
                    </TitleSource>
                    {articles}
                    <div>
                        <Pagination
                          activePage={this.state.activePage}
                          itemsCountPerPage={pagination.per_page}
                          totalItemsCount={pagination.total}
                          pageRangeDisplayed={5}
                          onChange={this.handlePageChange.bind(this)}
                          itemClass="page-item"
                          linkClass="page-link"
                        />
                    </div>
                </>
            )
        }
    }
}


export default ArticleList;
