using System;
using System.Data;
using System.Text;
using System.Data.SqlClient;
using Maticsoft.DBUtility;//Please add references
namespace Maticsoft.DAL
{
	/// <summary>
	/// 数据访问类:atbiao
	/// </summary>
	public partial class atbiao
	{
		public atbiao()
		{}
		#region  BasicMethod

		/// <summary>
		/// 得到最大ID
		/// </summary>
		public int GetMaxId()
		{
		return DbHelperSQL.GetMaxID("data_num", "atbiao"); 
		}

		/// <summary>
		/// 是否存在该记录
		/// </summary>
		public bool Exists(string id,int data_num)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("select count(1) from atbiao");
			strSql.Append(" where id=@id and data_num=@data_num ");
			SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@data_num", SqlDbType.Int,4)			};
			parameters[0].Value = id;
			parameters[1].Value = data_num;

			return DbHelperSQL.Exists(strSql.ToString(),parameters);
		}



		/// <summary>
		/// 增加一条数据
		/// </summary>
		public bool Add(Maticsoft.Model.atbiao model)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("insert into atbiao(");
			strSql.Append("id,data_num,ids,total)");
			strSql.Append(" values (");
			strSql.Append("@id,@data_num,@ids,@total)");
			SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@data_num", SqlDbType.Int,4),
					new SqlParameter("@ids", SqlDbType.VarChar,8000),
					new SqlParameter("@total", SqlDbType.Int,4)};
			parameters[0].Value = model.id;
			parameters[1].Value = model.data_num;
			parameters[2].Value = model.ids;
			parameters[3].Value = model.total;

			int rows=DbHelperSQL.ExecuteSql(strSql.ToString(),parameters);
			if (rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		/// <summary>
		/// 更新一条数据
		/// </summary>
		public bool Update(Maticsoft.Model.atbiao model)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("update atbiao set ");
			strSql.Append("ids=@ids,");
			strSql.Append("total=@total");
			strSql.Append(" where id=@id and data_num=@data_num ");
			SqlParameter[] parameters = {
					new SqlParameter("@ids", SqlDbType.VarChar,8000),
					new SqlParameter("@total", SqlDbType.Int,4),
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@data_num", SqlDbType.Int,4)};
			parameters[0].Value = model.ids;
			parameters[1].Value = model.total;
			parameters[2].Value = model.id;
			parameters[3].Value = model.data_num;

			int rows=DbHelperSQL.ExecuteSql(strSql.ToString(),parameters);
			if (rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		/// <summary>
		/// 删除一条数据
		/// </summary>
		public bool Delete(string id,int data_num)
		{
			
			StringBuilder strSql=new StringBuilder();
			strSql.Append("delete from atbiao ");
			strSql.Append(" where id=@id and data_num=@data_num ");
			SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@data_num", SqlDbType.Int,4)			};
			parameters[0].Value = id;
			parameters[1].Value = data_num;

			int rows=DbHelperSQL.ExecuteSql(strSql.ToString(),parameters);
			if (rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}


		/// <summary>
		/// 得到一个对象实体
		/// </summary>
		public Maticsoft.Model.atbiao GetModel(string id,int data_num)
		{
			
			StringBuilder strSql=new StringBuilder();
			strSql.Append("select  top 1 id,data_num,ids,total from atbiao ");
			strSql.Append(" where id=@id and data_num=@data_num ");
			SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@data_num", SqlDbType.Int,4)			};
			parameters[0].Value = id;
			parameters[1].Value = data_num;

			Maticsoft.Model.atbiao model=new Maticsoft.Model.atbiao();
			DataSet ds=DbHelperSQL.Query(strSql.ToString(),parameters);
			if(ds.Tables[0].Rows.Count>0)
			{
				return DataRowToModel(ds.Tables[0].Rows[0]);
			}
			else
			{
				return null;
			}
		}


		/// <summary>
		/// 得到一个对象实体
		/// </summary>
		public Maticsoft.Model.atbiao DataRowToModel(DataRow row)
		{
			Maticsoft.Model.atbiao model=new Maticsoft.Model.atbiao();
			if (row != null)
			{
				if(row["id"]!=null)
				{
					model.id=row["id"].ToString();
				}
				if(row["data_num"]!=null && row["data_num"].ToString()!="")
				{
					model.data_num=int.Parse(row["data_num"].ToString());
				}
				if(row["ids"]!=null)
				{
					model.ids=row["ids"].ToString();
				}
				if(row["total"]!=null && row["total"].ToString()!="")
				{
					model.total=int.Parse(row["total"].ToString());
				}
			}
			return model;
		}

		/// <summary>
		/// 获得数据列表
		/// </summary>
		public DataSet GetList(string strWhere)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("select id,data_num,ids,total ");
			strSql.Append(" FROM atbiao ");
			if(strWhere.Trim()!="")
			{
				strSql.Append(" where "+strWhere);
			}
			return DbHelperSQL.Query(strSql.ToString());
		}

		/// <summary>
		/// 获得前几行数据
		/// </summary>
		public DataSet GetList(int Top,string strWhere,string filedOrder)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("select ");
			if(Top>0)
			{
				strSql.Append(" top "+Top.ToString());
			}
			strSql.Append(" id,data_num,ids,total ");
			strSql.Append(" FROM atbiao ");
			if(strWhere.Trim()!="")
			{
				strSql.Append(" where "+strWhere);
			}
			strSql.Append(" order by " + filedOrder);
			return DbHelperSQL.Query(strSql.ToString());
		}

        /// <summary>
        /// 获得所有id
        /// </summary>
        public DataSet GetAllId()
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("select id from atbiao group by id ");
            return DbHelperSQL.Query(strSql.ToString());
        }


		/// <summary>
		/// 获取记录总数
		/// </summary>
		public int GetRecordCount(string strWhere)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("select count(1) FROM atbiao ");
			if(strWhere.Trim()!="")
			{
				strSql.Append(" where "+strWhere);
			}
			object obj = DbHelperSQL.GetSingle(strSql.ToString());
			if (obj == null)
			{
				return 0;
			}
			else
			{
				return Convert.ToInt32(obj);
			}
		}
		/// <summary>
		/// 分页获取数据列表
		/// </summary>
		public DataSet GetListByPage(string strWhere, string orderby, int startIndex, int endIndex)
		{
			StringBuilder strSql=new StringBuilder();
			strSql.Append("SELECT * FROM ( ");
			strSql.Append(" SELECT ROW_NUMBER() OVER (");
			if (!string.IsNullOrEmpty(orderby.Trim()))
			{
				strSql.Append("order by T." + orderby );
			}
			else
			{
				strSql.Append("order by T.data_num desc");
			}
			strSql.Append(")AS Row, T.*  from atbiao T ");
			if (!string.IsNullOrEmpty(strWhere.Trim()))
			{
				strSql.Append(" WHERE " + strWhere);
			}
			strSql.Append(" ) TT");
			strSql.AppendFormat(" WHERE TT.Row between {0} and {1}", startIndex, endIndex);
			return DbHelperSQL.Query(strSql.ToString());
		}

		/*
		/// <summary>
		/// 分页获取数据列表
		/// </summary>
		public DataSet GetList(int PageSize,int PageIndex,string strWhere)
		{
			SqlParameter[] parameters = {
					new SqlParameter("@tblName", SqlDbType.VarChar, 255),
					new SqlParameter("@fldName", SqlDbType.VarChar, 255),
					new SqlParameter("@PageSize", SqlDbType.Int),
					new SqlParameter("@PageIndex", SqlDbType.Int),
					new SqlParameter("@IsReCount", SqlDbType.Bit),
					new SqlParameter("@OrderType", SqlDbType.Bit),
					new SqlParameter("@strWhere", SqlDbType.VarChar,1000),
					};
			parameters[0].Value = "atbiao";
			parameters[1].Value = "data_num";
			parameters[2].Value = PageSize;
			parameters[3].Value = PageIndex;
			parameters[4].Value = 0;
			parameters[5].Value = 0;
			parameters[6].Value = strWhere;	
			return DbHelperSQL.RunProcedure("UP_GetRecordByPage",parameters,"ds");
		}*/


        //查看该id被关注了多少次
        public int BeiNum(string id)
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("select * from atnum");
            strSql.Append(" where id=");
            strSql.Append("'"+ id + "'");
            DataSet ds = DbHelperSQL.Query(strSql.ToString());
            DataTable dt = ds.Tables[0];
            int j = 0;
            foreach (DataRow dr in dt.Rows)   ///遍历所有的行
            {
                j = Convert.ToInt32(dr["num"]);
                break;
            }
            return j;
        }

        //插入一条被关注数据
        public Boolean BeiRecord(string id, int num )
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("insert into atnum(");
            strSql.Append("id,num)");
            strSql.Append(" values (");
            strSql.Append("@id,@num)");
            SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@num", SqlDbType.Int,4)
				};
            parameters[0].Value = id;
            parameters[1].Value = num;

            int rows = DbHelperSQL.ExecuteSql(strSql.ToString(), parameters);
            if (rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //更改一条被关注数据
        public Boolean UDBeiRecord(string id, int num)
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("update atnum set num = @num where id = @id");
            SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@num", SqlDbType.Int,4)
				};
            parameters[0].Value = id;
            parameters[1].Value = num;

            int rows = DbHelperSQL.ExecuteSql(strSql.ToString(), parameters);
            if (rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }


        //查看该id被关注了多少次 巴松狼王
        public int BaNum(string id)
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("select * from Bnum");
            strSql.Append(" where id=");
            strSql.Append("'" + id + "'");
            DataSet ds = DbHelperSQL.Query(strSql.ToString());
            DataTable dt = ds.Tables[0];
            int j = 0;
            foreach (DataRow dr in dt.Rows)   ///遍历所有的行
            {
                j = Convert.ToInt32(dr["num"]);
                break;
            }
            return j;
        }

        //插入一条被关注数据  巴松狼王
        public Boolean BaRecord(string id, int num)
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("insert into Bnum(");
            strSql.Append("id,num)");
            strSql.Append(" values (");
            strSql.Append("@id,@num)");
            SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@num", SqlDbType.Int,4)
				};
            parameters[0].Value = id;
            parameters[1].Value = num;

            int rows = DbHelperSQL.ExecuteSql(strSql.ToString(), parameters);
            if (rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //更改一条被关注数据  巴松狼王
        public Boolean UDBaRecord(string id, int num)
        {
            StringBuilder strSql = new StringBuilder();
            strSql.Append("update Bnum set num = @num where id = @id");
            SqlParameter[] parameters = {
					new SqlParameter("@id", SqlDbType.VarChar,20),
					new SqlParameter("@num", SqlDbType.Int,4)
				};
            parameters[0].Value = id;
            parameters[1].Value = num;

            int rows = DbHelperSQL.ExecuteSql(strSql.ToString(), parameters);
            if (rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

		#endregion  BasicMethod
		#region  ExtensionMethod

		#endregion  ExtensionMethod
	}
}

