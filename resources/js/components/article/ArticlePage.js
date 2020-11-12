import React, { Component } from 'react';
import axios from 'axios';
import './ArticlePage.scss';
import { TitleSource } from '../teleporters/Title'
import Helmet from 'react-helmet';

class ArticlePage extends Component
{
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            article : [],
        };
    }

    componentDidMount() {
        const { slug } = this.props.match.params;
        axios.get(process.env.MIX_API_URL+'/api/article/'+slug)
        .then(res => {
            this.setState({
                isLoaded: true,
                article: res.data
            });
        })
        .catch (error => {
            this.setState({
                isLoaded: true,
                error: error.response.statusText
            });
        });
    }

    render() {
        const { error, isLoaded, article } = this.state;
        if (error) {
          return <div className="alert alert-danger"> Error: {error} </div>;
        } else if (!isLoaded) {
          return <div>Loading...</div>;
        } else {
            return (
                <>
                    <Helmet>
                        <title>{article.name}</title>
                    </Helmet>
                    <TitleSource>{article.name}</TitleSource>
                    <div className="article-page">
                        <div className="ap-sub-info">
                            <span className="ap-date">{article.created_at}</span>|<span
                            className="ap-tags">{(article.tags).map(tag => { return tag.title }).join(', ')}</span>
                        </div>
                        <div className="ap-body">
                            {article.body}
                        </div>
                    </div>
                </>
            )
        }
    }
}

export default ArticlePage;
